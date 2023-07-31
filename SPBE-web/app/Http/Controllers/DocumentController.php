<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Aspect;
use App\Models\Document;
use App\Models\Indicator;
use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $attributes = Document::join('indicators','documents.indicator_id','=','indicators.id')
                ->join('aspects','indicators.aspect_id','=','aspects.id')
                ->join('domains','aspects.domain_id','=','domains.id')
                ->join('opds','documents.opd_id','=','opds.id')
                ->join('users','users.opd_id','=','opds.id')
                ->select('documents.*','domains.domain_name','aspects.aspect_name','indicators.indicator_name','opds.opd_name as opd_name')
                ->orderBy('updated_at','desc');
        $opds = Opd::all();
        $domains = Domain::all();
        $aspects = Aspect::all();
        $documents = Document::all();
        $indicators = Indicator::all();

        if(($user->hasRole('admin')) || ($user->hasRole('supervisor'))) {
            $attributes = $attributes->paginate(10);
            return view('pages.document', compact('attributes','opds','indicators','domains','aspects','documents'));
        } else {
            $userId = $user->id;
            $attributes = $attributes->where('users.id', $userId)->paginate(10);
            return view('pages.document', compact('attributes','opds','indicators','domains','aspects','documents'));
        }
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
            'opd_id'=>'required',
            'indicator_id'=>'required',
            'file'=>'nullable|file'
        ]);

        $document = new Document();
        $document->doc_name = $request->input('doc_name');
        $document->indicator_id = $request->input('indicator_id');
        $document->opd_id = $request->input('opd_id');

        if ($request->hasFile('file')) {
            Storage::makeDirectory(public_path('uploads'));
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
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
    public function update(Request $request, Document $document): RedirectResponse
    {
        $request->validate([
            'doc_name'=>'required',
            'file'=>'nullable|file'
        ]);

        $document->doc_name = $request->input('doc_name');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');

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
    public function destroy(Document $document): RedirectResponse
    {
        if ($document->upload_path) {
            Storage::disk('public')->delete($document->upload_path);
        }
        $document->delete();
        return redirect()->route('document')
            ->with('success', 'Dokumen berhasil dihapus');
    }

    public function searchDocument(Request $request)
    {
        $keyword = $request->input('keyword');

        // Search indicators by indicator_name
        // $indicatorIds = Indicator::where('indicator_name', 'LIKE', '%' . $keyword . '%')->pluck('id');

        // Get all documents that are related to the matching indicators
        $attributes = Document::join('indicators','documents.indicator_id','=','indicators.id')
            ->join('aspects','indicators.aspect_id','=','aspects.id')
            ->join('domains','aspects.domain_id','=','domains.id')
            ->join('opds','documents.opd_id','=','opds.id')
            ->join('users','users.opd_id','=','opds.id')
            ->select('documents.*', 'domains.domain_name', 'aspects.aspect_name', 'indicators.indicator_name', 'users.name as username')
            ->where(function ($query) use ($keyword) {
                $query->where('indicators.indicator_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('documents.doc_name', 'LIKE', '%' . $keyword . '%');
            })
            // ->whereIn('documents.indicator_id', $indicatorIds)
            ->paginate(10);

        $usernames = User::all();
        $opds = Opd::all();
        $domains = Domain::all();
        $aspects = Aspect::all();
        $documents = Document::all();
        $indicators = Indicator::all();

        return view('pages.document', compact('attributes', 'usernames', 'opds', 'indicators', 'domains', 'aspects', 'documents'));
    }

}
