<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $attributes = DB::table('documents')
            ->join('indicators','documents.indicator_id','=','indicators.id')
            ->join('aspects','indicators.aspect_id','=','aspects.id')
            ->join('domains','aspects.domain_id','=','domains.id')
            ->join('users','documents.user_id','=','users.id')
            ->select('documents.*','domains.domain_name','aspects.aspect_name','indicators.indicator_name')
            ->paginate(10);
    return view('pages.document', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'doc_name'=>'required',
            'file'=>'nullable'
        ]);

        $document = new Document();
        $document->doc_name = $request->input('doc_name');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('documents');
            $document->upload_path = $path;
        }

        $document->save();
        return redirect()->route('document')
            ->with('success', 'Dokumen berhasil diupload');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return view('pages.tables',compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'doc_name'=>'required',
            'file'=>'nullable|file'
        ]);

        $document = Document::findOrFail($id);
        $document->doc_name = $request->input('doc_name');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('documents');

            if ($document->upload_path) {
                Storage::delete($document->upload_path);
            }

            $document->upload_path = $path;
        }

        $document->save();

        return redirect()->route('document')
            ->with('success', 'Dokumen berhasil diupload');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document, $id)
    {
        $document = Document::findOrFail($id);

        if ($document->upload_path) {
            Storage::delete($document->upload_path);
        }

        $document->delete();

        return redirect()->route('document')
            ->with('success', 'Dokumen berhasil dihapus');
    }
}
