<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Indicator;
use App\Models\Document;
use App\Models\Aspect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ScoreController extends Controller
{
    public function index():View
    {
        $attributes = Indicator::leftJoin('documents','documents.indicator_id','=','indicators.id')
            ->join('aspects','indicators.aspect_id','=','aspects.id')
            ->join('domains','aspects.domain_id','=','domains.id')
            ->select('indicators.*','documents.doc_name','documents.upload_path','documents.upload_path','aspects.aspect_name','domains.domain_name')
            ->paginate(10);
        foreach ($attributes as $attribute){
            $attribute->documents = $attribute->documents()->get();
        }

        $aspects = Aspect::all();
        return view('pages.score', compact('attributes', 'aspects'));
    }

    public function indexDetail($year):View
    {
        $attributes = Indicator::leftJoin('documents','documents.indicator_id','=','indicators.id')
            ->join('aspects','indicators.aspect_id','=','aspects.id')
            ->join('domains','aspects.domain_id','=','domains.id')
            ->whereYear('indicators.updated_at', $year)
            ->select('indicators.*','documents.doc_name','documents.upload_path','documents.upload_path','aspects.aspect_name','domains.domain_name')
            ->paginate(10);
        foreach ($attributes as $attribute){
            $attribute->documents = $attribute->documents()->get();
        }

        $aspects = Aspect::all();
        return view('pages.scores.show', compact('attributes', 'aspects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Indicator $indicator)
    {
        
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
            'score' => 'required'
        ]);

        // Update data di database
        $indicator->update([
            'score' => $request->input('score'),
        ]);

        // return dd($request, $indicator->score);

        return redirect()->route('score')
            ->with('success','Score berhasil diubah');
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
