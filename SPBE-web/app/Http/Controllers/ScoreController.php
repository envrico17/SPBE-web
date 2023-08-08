<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Indicator;
use App\Models\Document;
use App\Models\Aspect;
use App\Models\Score;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ScoreController extends Controller
{
    public function index():View
    {
        // $scores = Score::all();
        $attributes = Score::with('indicators')->paginate(10);

        return view('pages.score', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'score_name' => 'required',
                'score_description' => 'nullable',
                'score_date' => 'required',
                'score_date_range' => 'nullable'
            ]);

            // Simpan data ke database
            $reqForm = Indicator::create([
                'score_name' => $request->input('score_name'),
                'score_description' => $request->input('score_description'),
                'score_date' => $request->input('score_date'),
                'score_date_range' => $request->input('score_date_range')
            ]);

            return redirect()->route('indicator')
                ->with('success','Form berhasil dibuat');
        } catch (ValidationException $e) {
            // Handle validation exception (form validation errors)
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database error)
            return redirect()->back()
                ->with('error', 'Gagal membuat form. Silahkan coba lagi.');
        }
    }

    public function indexDetail(Score $score):View
    {
        // $attributes = Indicator::leftJoin('documents','documents.indicator_id','=','indicators.id')
        //     ->join('scores','indicators.score_id','=','scores.id')
        //     ->join('aspects','indicators.aspect_id','=','aspects.id')
        //     ->join('domains','aspects.domain_id','=','domains.id')
        //     ->where('scores.score_date', $score->score_date)
        //     ->select('indicators.*','documents.doc_name','documents.upload_path','documents.upload_path','aspects.aspect_name','domains.domain_name')
        //     ->paginate(10);
        $attributes = Indicator::where('score_id', $score->id)->paginate(10);
        foreach ($attributes as $attribute){
            $attribute->documents = $attribute->documents()->get();
            $attribute->scoreForm = $attribute->score()->first();
        }

        $aspects = Aspect::all();
        return view('pages.scores.show', compact('attributes','score'));
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
    public function edit(Score $score)
    {
        return view('pages.scores.edit', compact('score'));
    }

    public function updateForm(Request $request, Score $score): RedirectResponse
    {
        $request->validate([
            'score_name' => 'required',
            'score_description' => 'nullable',
        ]);

        $score->update($request->all());

        return redirect()->route('score')
            ->with('success','Form Score berhasil diubah');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score, Indicator $indicator): RedirectResponse
    {
        try {
            $request->validate([
                'score' => 'required'
            ]);

            // Update data di database
            $indicator->update($request->all());

            // return dd($request, $indicator);

            return redirect()->back()
                ->with('success','Score berhasil diubah');
        } catch (ValidationException $e) {
            // Handle validation exception (form validation errors)
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database error)
            return redirect()->back()
                ->with('error', 'Gagal update aspek. Silahkan coba lagi.');
        }
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

    public function clone($score_id)
    {
        $score = Score::findOrFail($score_id);
        $new_score = $score->duplicate();
        $new_score->save();

        return redirect()->route('score.edit', $new_score);
    }
}
