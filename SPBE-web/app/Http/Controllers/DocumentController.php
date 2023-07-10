<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
use App\Models\Document;
use App\Models\Domain;
use App\Models\Indicator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $attributes = DB::table('documents')
            ->join('indicators','documents.indicator_id','=','indicators.id')
            ->join('aspects','indicators.aspect_id','=','aspects.id')
            ->join('domains','aspects.domain_id','=','domains.id')
            ->join('users','documents.user_id','=','users.id')
            ->get();
    return view('pages.tables', compact('attributes'));
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
        // $request->validate([
        //     'domain_name' => '',
        //     'aspect_name' => ''
        // ])
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return view('pages.tables',compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }
}
