<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $attributes = DB::table('aspects')
            ->join('domains','domains.id','=','aspects.domain_id')
            // ->select('aspects.id as aspect_id','aspect_name','domains.id as domain_id','domain_name','timestamp')
            ->select('aspects.*','domains.domain_name')
            ->paginate(10);
        $domains = DB::table('domains')->get();
        return view('pages.aspect', compact('attributes','domains'));
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
            'aspect_name' => 'required',
            'domain_id' => 'required'
        ]);
        Aspect::create($request->all());
        return redirect()->route('aspect')
            ->with('success','Aspek berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspect $aspect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aspect $aspect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aspect $aspect): RedirectResponse
    {
        $request->validate([
            'aspect_name' => 'required'
        ]);
        $aspect->update($request->all());
        return redirect()->route('aspect')
            ->with('success','Aspek berhasil dibuat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aspect $aspect): RedirectResponse
    {
        $aspect->delete();
        return redirect()->route('aspect')
            ->with('success','Aspek berhasil dihapus');
    }
}
