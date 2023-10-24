<?php

namespace App\Http\Controllers;

use App\Models\Profile;
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
    public function show($id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return redirect()->route('home')->with('error', 'Profiel niet gevonden.');
        }

        return view('view', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profile = Profile::find($id);
        return view('edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::where('user_id', Auth::id())->find($id);

        // Voer validatie uit voor de bewerkte gegevens, inclusief de image-upload
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:18|max:30',
        ]);

        if (!$profile) {
            return redirect()->route('home')->with('error', 'Profiel niet gevonden!');
        }

        // Als een nieuwe afbeelding is geüpload, sla deze op
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('/images', 'public');
            $imagePath = str_replace('images/', '', $imagePath);
            $profile->image = $imagePath;
        }

        // Sla de bewerkte gegevens op in de database
        $profile->name = $request->input('name');
        $profile->gender = $request->input('gender');
        $profile->age = $request->input('age');
        $profile->bio = $request->input('bio');
        $profile->save();

        return redirect()->route('home')->with('success', 'Profiel bijgewerkt!');
    }




    /**
     * Remove the specified resource from storage.
     */

    public function destroy(profile $profile)
    {
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'Je moet ingelogd zijn om een profiel te verwijderen!');
        }

        if (Auth::id() !== $profile->user_id) {
            $profile->delete();
            return redirect()->route('home')->with('success', 'Profiel verwijderd!');
        } else {
            return redirect()->route('home')->with('error', 'Profiel niet verwijderd!');
        }
    }

    public function status(Profile $profile)
    {
        $this->authorize('update', $profile);

        // Wissel de status om
        $profile->update(['active' => !$profile->active]);

        return back()->with('success', 'Profielstatus gewijzigd.');
    }

}
