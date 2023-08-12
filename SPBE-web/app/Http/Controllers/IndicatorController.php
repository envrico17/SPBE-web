<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
use App\Models\Indicator;
use App\Models\Score;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $aspects = Aspect::all();

        $keyword = $request->input('keyword');

        $attributes = Indicator::with('domain')->orderBy('id','asc');

        if($keyword){
            $attributes = $attributes->where('indicator_name', 'like', '%' . $keyword . '%');
        }

        $attributes = $attributes->paginate(10);

        $attributes = $attributes->appends(['keyword' => $keyword]);

        return view('pages.indicator', compact('attributes', 'aspects', 'keyword'));
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
                'indicator_name' => 'required',
                'aspect_id' => 'required',
                'description' => 'required',
            ]);

            // Simpan data ke database
            Indicator::create([
                'indicator_name' => $request->input('indicator_name'),
                'aspect_id' => $request->input('aspect_id'),
                'description' => $request->input('description'),
            ]);

            return redirect()->route('indicator')
                ->with('success', 'Indikator berhasil dibuat');
        } catch (ValidationException $e) {
            // Handle validation exception (form validation errors)
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database error)
            return redirect()->back()
                ->with('error', 'Gagal membuat indikator. Silahkan coba lagi.');
        }
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
        try {
            $request->validate([
                'indicator_name' => 'nullable'
            ]);

            // Update data di database
            $indicator->update([
                'indicator_name' => $request->input('indicator_name'),
                'description' => $request->input('description'),
            ]);

            // return dd($request, $indicator);

            return redirect()->route('indicator')
                ->with('success', 'Indikator berhasil diubah');
        } catch (ValidationException $e) {
            // Handle validation exception (form validation errors)
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database error)
            return redirect()->back()
                ->with('error', 'Gagal update indikator. Silahkan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indicator $indicator): RedirectResponse
    {
        try {
            $indicator->delete();
            return redirect()->route('indicator')
                ->with('success', 'Indikator berhasil dihapus');
        } catch (ValidationException $e) {
            // Handle validation exception (form validation errors)
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database error)
            return redirect()->back()
                ->with('error', 'Gagal menghapus indikator. Silahkan coba lagi.');
        }
    }

    public function searchIndicator(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->input('keyword');
        $attributes = Indicator::where('indicator_name', 'like', '%' . $keyword . '%')->orderBy('id','')->paginate(10);
        foreach ($attributes as $attribute) {
            $attribute->scoreForm = $attribute->score()->first();
        }

        // Include the keyword in the pagination links
        $attributes->appends(['keyword' => $keyword]);

        $uniqueYears = DB::table('scores')->distinct()->pluck('score_date');
        $aspects = Aspect::all();
        $scores = Score::all();

        return view('pages.indicator', compact('attributes', 'aspects', 'uniqueYears','scores'));
    }
}
