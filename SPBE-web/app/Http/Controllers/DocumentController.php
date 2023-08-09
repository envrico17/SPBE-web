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
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $opds = Opd::all();
        // $domains = Domain::all();
        // $aspects = Aspect::all();
        // $documents = Document::all();
        $indicators = Indicator::all();

        $uniqueYears = DB::table('scores')->distinct()->pluck('score_date');

        if(($user->hasRole('admin')) || ($user->hasRole('supervisor'))) {
            $attributes = Indicator::paginate(10);
            foreach ($attributes as $attribute){
                $attribute->scoreForm = $attribute->score()->first();
            }
            return view('pages.document', compact('attributes','indicators','opds','uniqueYears'));
        } else {
            $userOpdId = $user->opd_id;
            $attributes = Indicator::with('documents')->paginate(10);
            foreach ($attributes as $attribute){
                $attribute->scoreForm = $attribute->score()->first();
            }
            return view('pages.document', compact('attributes','indicators','opds','uniqueYears'));
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
        try{
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
        $attributes = Indicator::leftJoin('documents','documents.indicator_id','=','indicators.id')
                ->join('aspects','indicators.aspect_id','=','aspects.id')
                ->join('domains','aspects.domain_id','=','domains.id')
                ->leftJoin('opds','documents.opd_id','=','opds.id')
                ->select('indicators.*','documents.doc_name','documents.upload_path','documents.upload_path','aspects.aspect_name','domains.domain_name');
        $opds = Opd::all();
        $domains = Domain::all();
        $aspects = Aspect::all();

        $aspect = $indicator->aspect;
        $domain = $aspect->domain;
        $allDocuments = $indicator->documents;

        if(($user->hasRole('admin')) || ($user->hasRole('supervisor'))) {
            $attributes = $attributes->get();
            $documents = $allDocuments;
        } else {
            $userOpdId = $user->opd_id;
            $attributes = $attributes->where('opds.id', $userOpdId)->get();
            $documents = $allDocuments->filter(function ($document) use ($user) {
                return $document->opd_id === $user->opd_id;
            });
        }

        foreach ($documents as $document){
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
                'doc_name'=>'required',
                'file'=>'nullable|file'
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

    public function searchDocument(Request $request)
    {
        $keyword = $request->input('keyword');
        $user = Auth::user();

        $opds = Opd::all();
        // $domains = Domain::all();
        // $aspects = Aspect::all();
        // $documents = Document::all();
        $indicators = Indicator::all();

        $uniqueYears = DB::table('scores')->distinct()->pluck('score_date');

        if(($user->hasRole('admin')) || ($user->hasRole('supervisor'))) {
            $attributes = Indicator::join('scores','scores.id','=','indicators.score_id')
            ->where(function ($query) use ($keyword) {
                $query->where('indicator_name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('score_date', 'like', '%' . $keyword . '%');
                // Add more columns to search here...
            })->paginate(10);
            foreach ($attributes as $attribute){
                $attribute->scoreForm = $attribute->score()->first();
            }
            return view('pages.document', compact('attributes','indicators','opds','uniqueYears'));
        } else {
            $userOpdId = $user->opd_id;
            $attributes = Indicator::where(function ($query) use ($keyword) {
                $query->where('indicator_name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('scores.score_date', 'like', '%' . $keyword . '%');
                // Add more columns to search here...
            })->paginate(10);
            foreach ($attributes as $attribute){
                $attribute->scoreForm = $attribute->score()->first();
            }
            return view('pages.document', compact('attributes','indicators','opds','uniqueYears'));
        }

        // $attributes = Indicator::join('scores','scores.id','=','indicators.score_id')
        //     ->where(function ($query) use ($keyword) {
        //     $query->where('indicator_name', 'like', '%' . $keyword . '%')
        //         ->orWhere('description', 'like', '%' . $keyword . '%')
        //         ->orWhere('score_date', 'like', '%' . $keyword . '%');
        //     // Add more columns to search here...
        // })->paginate(10);

        // $usernames = User::all();
        // $opds = Opd::all();
        // $domains = Domain::all();
        // $aspects = Aspect::all();
        // $documents = Document::all();
        // $indicators = Indicator::all();

        // return view('pages.document', compact('attributes', 'usernames', 'opds', 'indicators', 'domains', 'aspects', 'documents'));
    }

}
