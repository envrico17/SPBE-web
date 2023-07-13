<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $attributes = DB::table('indicators')
            ->join('aspects','indicators.aspect_id','=','aspects.id')
            ->select('indicators.*','aspects.aspect_name')
            ->paginate(10);
        $aspects = DB::table('aspects')->get();
        return view('pages.indicator', compact('attributes', 'aspects'));
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
        Indicator::create($request->all());
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
        $indicator->update($request->all());
        return redirect()->route('indicator')
            ->with('success','Indikator berhasil dibuat');
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
