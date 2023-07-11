<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
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
        $attributes = DB::table('documents')
            ->join('indicators','documents.indicator_id','=','indicators.id')
            ->join('aspects','indicators.aspect_id','=','aspects.id')
            ->join('domains','aspects.domain_id','=','domains.id')
            ->join('users','documents.user_id','=','users.id')
            ->paginate(10);
        return view('pages.aspect', compact('attributes'));
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
        // $request = validate([
        //     'aspect_name' => 'required'
        // ]);
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
    public function update(Request $request, Aspect $aspect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aspect $aspect)
    {
        //
    }
}
