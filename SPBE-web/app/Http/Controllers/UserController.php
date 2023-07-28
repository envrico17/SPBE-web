<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = User::join('opds','opds.user_id','=','users.id')
            ->select('users.*','opds.opd_name')
            ->orderBy('updated_at','desc')
            ->paginate(10);
            $users = User::all();
            $opds = Opd::all();
            return view('pages.user', compact('attributes','opds'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255|confirmed',
            'nip' => 'nullable|min:16',
            'pangkat' => 'nullable',
            'phone' => 'nullable',

        ]);

        $user = User::create($request->all());
        return redirect()->route('user')
            ->with('success','User berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            // 'email' => 'required|email|max:255|unique:users,email',
            // 'password' => 'required|min:5|max:255',
            'nip' => 'nullable',
            'pangkat' => 'nullable',
            'phone' => 'nullable',
        ]);
        $user->update($request->all());
        return redirect()->route('user')
            ->with('success','User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user')
            ->with('success','User berhasil dihapus');
    }

    public function searchUser(Request $request)
    {
        $keyword = $request->input('keyword');
        $attributes = User::join('opds','opds.user_id','=','users.id')
            ->select('users.*','opds.opd_name')
            ->where(function ($query) use ($keyword) {
                $query->where('users.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('opds.opd_name', 'LIKE', '%' . $keyword . '%');
            })
            // ->whereIn('documents.indicator_id', $indicatorIds)
            ->orderBy('updated_at','desc')
            ->paginate(10);

            $users = User::all();
            $opds = Opd::all();
            return view('pages.user', compact('attributes','opds'));
    }
}
