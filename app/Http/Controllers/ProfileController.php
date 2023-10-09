<?php

namespace App\Http\Controllers;

use App\Models\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
    $profiles = profile::all();
    return view('profiles.index', compact('profiles'));

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
    public function show(profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(profile $profile)
    {
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'Je moet ingelogd zijn om een profiel te verwijderen!');
        }

        if (Auth::id() !== $profile->users_id) {
            $profile->delete();
            return redirect()->route('home')->with('success', 'Profiel verwijderd!');

        } else {
            return redirect()->route('home')->with('error', 'Profiel niet verwijderd!');
        }
    }
}
