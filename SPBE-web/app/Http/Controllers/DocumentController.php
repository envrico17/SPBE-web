<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Aspect;
use App\Models\Document;
use App\Models\Indicator;
use App\Models\Opd;
use App\Models\User;
use App\Models\Score;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        $opds = Opd::all();
        $indicators = Indicator::all();

        try {
            $keyword = $request->input('keyword'); // Get the selected option from the query parameter

            if (is_null($keyword)) {
                // No option selected, fetch data without filtering
                $query = Indicator::query();
            } else {
                // Option selected, fetch data based on the selected option
                $query = Indicator::where('indicator_name', 'like', '%' . $keyword . '%');
            }

            if ($user->hasRole('user')) {
                $query = $query->whereHas('documents', function(Builder $builder){
                    $user = Auth::user();
                    $builder->where('opd_id', $user->opd_id);
                });
            }

            $attributes = $query->paginate(10);

            // Include the selected keyword in the pagination links
            $attributes->appends(['keyword' => $keyword]);

            return view('pages.document', compact('attributes'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard')->with('error', 'Filtered data not found.');
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
        try {
            $request->validate([
                'doc_name' => 'required',
                'opd_id' => 'required',
                'indicator_id' => 'required',
                'file' => 'nullable|file'
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

            return back()->with('success', 'Entri Dokumen berhasil ditambah');
        } catch (ValidationException $e) {
            // Handle validation exception (form validation errors)
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database error)
            return redirect()->back()
                ->with('error', 'Gagal menambah entri dokumen. Silahkan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Indicator $indicator)
    {
        $user = Auth::user();
        $opds = Opd::all();

        $documents = Document::where('indicator_id', $indicator->id);

        if($user->hasRole('user')){
            $documents = $documents->where('opd_id',$user->opd_id)->paginate(10);
        } else {
            $documents = $documents->paginate(10);
        }

        return view('pages.documents.show', compact('indicator','documents','opds'));
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
        try {
            $request->validate([
                'doc_name' => 'required',
                'file' => 'nullable|file'
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public');

                if ($document->upload_path) {
                    Storage::delete($document->upload_path);
                }

                $document->upload_path = $path;
            }

            $document->update($request->all());
            $document->save();

            return back()->with('success', 'Dokumen berhasil diupload');
        } catch (ValidationException $e) {
            // Handle validation exception (form validation errors)
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database error)
            return redirect()->back()
                ->with('error', 'Gagal update dokumen. Silahkan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document): RedirectResponse
    {
        try {
            if ($document->upload_path) {
                Storage::disk('public')->delete($document->upload_path);
            }
            $document->delete();
            return back()->with('success', 'Dokumen berhasil dihapus');
        } catch (ValidationException $e) {
            // Handle validation exception (form validation errors)
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database error)
            return redirect()->back()
                ->with('error', 'Gagal menghapus entri dokumen. Silahkan coba lagi.');
        }
    }
}
