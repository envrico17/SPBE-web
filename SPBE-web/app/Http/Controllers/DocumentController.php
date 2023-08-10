<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Aspect;
use App\Models\Document;
use App\Models\Indicator;
use App\Models\Opd;
use App\Models\User;
use App\Models\Score;

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
    public function index()
    {

        $option = FacadesRequest::query('option');
        $user = Auth::user();

        $opds = Opd::all();
        $indicators = Indicator::all();
        $scores = Score::all();

        $uniqueScores = $scores->unique('score_date');

        try {
            $option = FacadesRequest::query('option'); // Get the selected option from the query parameter

            if (is_null($option)) {
                // No option selected, fetch data without filtering
                $query = Indicator::query();
            } else {
                // Option selected, fetch data based on the selected option
                $query = Indicator::where('score_id', $option);
            }

            if (!($user->hasRole('admin') || $user->hasRole('supervisor'))) {
                $query = $query->with('documents');
            }

            // Paginate the data
            $perPage = 10;
            $currentPage = FacadesRequest::query('page', 1);
            $attributes = $query->paginate($perPage, ['*'], 'page', $currentPage);

            foreach ($attributes as $attribute) {
                $attribute->scoreForm = $attribute->score()->first();
            }

            // Include the selected option in the pagination links
            $attributes->appends(['option' => $option]);

            return view('pages.document', compact('attributes', 'uniqueScores'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard')->with('error', 'Filtered data not found.');
        }
    }

    public function searchDocument(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->input('keyword');

        $scores = Score::all();
        $uniqueScores = $scores->unique('score_date');

        if ($user->hasRole('admin') || $user->hasRole('supervisor')) {
            $attributes = Indicator::where('indicator_name', 'like', '%' . $keyword . '%')->paginate(10);
        } else {
            $attributes = Indicator::with('documents')
                ->where('indicator_name', 'like', '%' . $keyword . '%')
                ->paginate(10);
        }

        foreach ($attributes as $attribute) {
            $attribute->scoreForm = $attribute->score()->first();
        }

        // Include the keyword in the pagination links
        $attributes->appends(['keyword' => $keyword]);

        return view('pages.document', compact('attributes','uniqueScores'));
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
        $attributes = Indicator::leftJoin('documents', 'documents.indicator_id', '=', 'indicators.id')
            ->join('aspects', 'indicators.aspect_id', '=', 'aspects.id')
            ->join('domains', 'aspects.domain_id', '=', 'domains.id')
            ->leftJoin('opds', 'documents.opd_id', '=', 'opds.id')
            ->select('indicators.*', 'documents.doc_name', 'documents.upload_path', 'documents.upload_path', 'aspects.aspect_name', 'domains.domain_name');
        $opds = Opd::all();
        $domains = Domain::all();
        $aspects = Aspect::all();

        $aspect = $indicator->aspect;
        $domain = $aspect->domain;
        $allDocuments = $indicator->documents;

        if (($user->hasRole('admin')) || ($user->hasRole('supervisor'))) {
            $attributes = $attributes->get();
            $documents = $allDocuments;
        } else {
            $userOpdId = $user->opd_id;
            $attributes = $attributes->where('opds.id', $userOpdId)->get();
            $documents = $allDocuments->filter(function ($document) use ($user) {
                return $document->opd_id === $user->opd_id;
            });
        }

        foreach ($documents as $document) {
            $document->opd = $document->opd()->first();
        }

        return view('pages.documents.show', compact('attributes', 'opds', 'domain', 'aspect', 'indicator', 'documents'));
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
