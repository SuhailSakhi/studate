<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;


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
        $profile = Profile::find($id); // Zoek het profiel op basis van het ID

        if (!$profile) {
            return redirect()->route('home')->with('error', 'Profiel niet gevonden.'); // Als het profiel niet bestaat, stuur de gebruiker terug naar de homepagina
        }

        return view('view', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profile = Profile::find($id); // Zoek het profiel op basis van het ID
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
            return redirect()->route('home')->with('error', 'Profiel niet gevonden!'); // Als het profiel niet bestaat, stuur de gebruiker terug naar de homepagina
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
        if (!Auth::check()) { // Controleer of de gebruiker is ingelogd
            return redirect()->route('home')->with('error', 'Je moet ingelogd zijn om een profiel te verwijderen!');
        }

        if (Auth::id() !== $profile->user_id) { // Controleer of de ingelogde gebruiker de eigenaar is van het profiel
            $profile->delete();
            return redirect()->route('home')->with('success', 'Profiel verwijderd!');
        } else {
            return redirect()->route('home')->with('error', 'Profiel niet verwijderd!');
        }
    }


    /**
     * Toggle the specified resource from storage.
     */


    public function manage()
    {
        if (Auth::user()->role === 'admin') { // Controleer of de gebruiker een admin is
            $profiles = Profile::all(); // Haal alle profielen op
            return view('manage', compact('profiles')); // Toon de view met de lijst van profielen
        } else {
            return redirect()->route('home')->with('error', 'Alleen beheerders hebben toegang tot deze pagina');
        }
    }

    public function toggleProfileStatus( Profile $profile)
    {
        {
            if (Auth::user()->role === 'admin') { // Controleer of de gebruiker een admin is
                $profile->is_active = ($profile->is_active == 1 ? 0 : 1); // Toggle de status van het profiel
                $profile->save(); // Sla de wijziging op in de database

                return redirect()->route('manage')->with('success', 'Profielstatus gewijzigd!');
            }
        }
    }

//    public function likeProfile(Profile $profile)
//    {
//        if (Auth::check()) {
//            // Haal sessie-interactieteller op
//            $interactionCount = Session::get('interaction_count', 0);
//
//            // Controleer of user voldoet aan de interactievereisten
//            if ($interactionCount >= 5) {
//                // Voer hier de like-actie uit
//
//                // Update de sessie-interactieteller
//                $interactionCount++;
//                Session::put('interaction_count', $interactionCount);
//
//                return redirect()->back()->with('success', 'Profiel geliket.');
//            } else {
//                return redirect()->back()->with('error', 'Je moet minimaal 5 interacties hebben voordat je kunt liken.');
//            }
//        } else {
//            return redirect()->back()->with('error', 'Je moet ingelogd zijn om te kunnen liken.');
//        }
//    }
//



}
