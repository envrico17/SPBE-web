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
    public function index(): View
    {

        $user = Auth::user();
        $uniqueYears = DB::table('scores')->distinct()->pluck('score_date');
        $aspects = Aspect::all();
        $scores = Score::all();

        $keyword = FacadesRequest::input('keyword');
        $selectedYear = FacadesRequest::input('year');

        if ($selectedYear) {
            if ($user->hasRole('admin') || $user->hasRole('supervisor')) {
                $attributes = Indicator::whereHas('score', function ($query) use ($selectedYear) {
                    $query->where('score_date', $selectedYear);
                })->paginate(10);
            } else {
                $attributes = Indicator::with('documents')
                    ->whereHas('score', function ($query) use ($selectedYear) {
                        $query->where('score_date', $selectedYear);
                    })
                    ->paginate(10);
            }

            foreach ($attributes as $attribute) {
                $attribute->scoreForm = $attribute->score()->first();
            }
        } else {
            // Default logic to fetch indicators
            $attributes = Indicator::paginate(10);
            foreach ($attributes as $attribute) {
                $attribute->scoreForm = $attribute->score()->first();
            }
        }

        $attributes->appends(['year' => $selectedYear]);

        return view('pages.indicator', compact('attributes', 'aspects', 'uniqueYears', 'keyword', 'selectedYear','scores'));
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
                'score_id' => 'required',
                'description' => 'required',
            ]);

            $aspect = Aspect::find($request->input('aspect_id'));
            $domain = $aspect->domain->first();
            $domain_id = $domain->id;

            // Simpan data ke database
            Indicator::create([
                'indicator_name' => $request->input('indicator_name'),
                'domain_id' => $domain_id,
                'aspect_id' => $request->input('aspect_id'),
                'score_id' => $request->input('score_id'),
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

        $uniqueYears = DB::table('scores')->distinct()->pluck('score_date');
        $aspects = Aspect::all();
        $scores = Score::all();

        return view('pages.indicator', compact('attributes', 'aspects', 'uniqueYears','scores'));
    }
}
