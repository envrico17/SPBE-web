<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreOpdRequest;
use App\Http\Requests\UpdateOpdRequest;
use PhpParser\Node\NullableType;

class OpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Opd::join('users','users.id','=','opds.user_id')
        ->select('opds.*','users.name')
        ->paginate(10);
        return view('pages.opd', compact('attributes'));
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
            'opd_name' => 'required',
            'user_id' => 'nullable'
        ]);
        OPD::create($request->all());
        return redirect()->route('opd')
            ->with('success','OPD berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Opd $opd)
    {
        return view('pages.opd', compact('opd'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Opd $opd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opd $opd): RedirectResponse
    {
        $request->validate([
            'opd_name' => 'required'
        ]);
        $opd->update($request->all());
        return redirect()->route('opd')
            ->with('success','OPD berhasil dibuat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opd $opd): RedirectResponse
    {
        $opd->delete();
        return redirect()->route('opd')
            ->with('success','OPD berhasil dihapus');
    }

    public function searchOPD(Request $request)
    {
        $keyword = $request->input('keyword');
        $attributes = OPD::where('opd_name', 'LIKE', '%' . $keyword . '%')->paginate(10);

        return view('pages.opd', compact('attributes'));
    }
}
