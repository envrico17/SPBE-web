<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
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
        $attributes = Indicator::join('aspects','indicators.aspect_id','=','aspects.id')
            ->join('domains','aspects.domain_id','=','domains.id')
            ->select('indicators.*','aspects.aspect_name','domains.domain_name')
            ->paginate(10);
        $aspects = Aspect::all();
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

    public function searchIndicator(Request $request)
    {
        $keyword = $request->input('keyword');
        $attributes = Indicator::join('aspects','indicators.aspect_id','=','aspects.id')
            ->join('domains','aspects.domain_id','=','domains.id')
            ->select('indicators.*','aspects.aspect_name','domains.domain_name')
            ->where(function ($query) use ($keyword) {
            $query->where('indicator_name', 'LIKE', '%' . $keyword . '%')->paginate(10);
            })
            ->paginate(10);

            $aspects = Aspect::all();
            return view('pages.indicator', compact('attributes','aspects'));
        }
}
