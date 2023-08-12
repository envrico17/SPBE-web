<?php

namespace App\Http\Controllers;

use App\Models\ScoreIndicator;
use App\Http\Requests\StoreScoreIndicatorRequest;
use App\Http\Requests\UpdateScoreIndicatorRequest;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ScoreIndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ScoreIndicator $scoreIndicator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScoreIndicator $scoreIndicator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score, ScoreIndicator $id)
    {
        try {
            $request->validate([
                'score' => 'required'
            ]);

            // Update data di database
            $id->update($request->all());

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
                ->with('error', 'Gagal update score. Silahkan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScoreIndicator $scoreIndicator)
    {
        //
    }
}
