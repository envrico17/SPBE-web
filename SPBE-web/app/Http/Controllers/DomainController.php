<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $attributes = Domain::paginate(10);
        return view('pages.domain', compact('attributes'));
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
            'domain_name' => 'required'
        ]);
        Domain::create($request->all());
        return redirect()->route('domain')
            ->with('success','Domain berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Domain $domain)
    {

        return view('pages.domain', compact('domain'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domain $domain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Domain $domain): RedirectResponse
    {
        $request->validate([
            'domain_name' => 'required'
        ]);
        $domain->update($request->all());
        return redirect()->route('domain')
            ->with('success','Domain berhasil dibuat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domain $domain): RedirectResponse
    {
        $domain->delete();
        return redirect()->route('domain')
            ->with('success','Domain berhasil dihapus');
    }

    public function searchDomain(Request $request)
    {
        $keyword = $request->input('keyword');
        $attributes = Domain::where('domain_name', 'LIKE', '%' . $keyword . '%')->paginate(10);

        return view('pages.domain', compact('attributes'));
    }
}
