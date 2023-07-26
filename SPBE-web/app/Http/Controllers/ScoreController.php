<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Indicator;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ScoreController extends Controller
{
    public function index():View
    {
        $attributes = Indicator::leftJoin('documents','documents.indicator_id','=','indicators.id')
            ->select('indicators.*','documents.doc_name','documents.updated_at')
            ->paginate(10);
        $documents = Document::all();
        return view('pages.score', compact('attributes', 'documents'));
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
            'indicator_name' => 'required',
            'aspect_id' => 'required',
            'description' => 'required'
        ]);

        // Simpan data ke database
        Indicator::create([
            'indicator_name' => $request->input('indicator_name'),
            'aspect_id' => $request->input('aspect_id'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('indicator')
            ->with('success','Indikator berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Indicator $indicator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Indicator $indicator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Indicator $indicator): RedirectResponse
    {
        $request->validate([
            'indicator_name' => 'required'
        ]);

        // Update data di database
        $indicator->update([
            'indicator_name' => $request->input('indicator_name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('indicator')
            ->with('success','Indikator berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indicator $indicator): RedirectResponse
    {
        $indicator->delete();
        return redirect()->route('indicator')
            ->with('success','Indikator berhasil dihapus');
    }
}
