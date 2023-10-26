<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search'); // Haal de zoekterm op uit de request
        $gender = $request->input('gender'); // Haal het geslacht op uit de request

        $query = Profile::query();

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%'); // Zoek op naam
                $query->orWhere('age', 'like', '%' . $searchTerm . '%'); // Zoek op leeftijd
            });
        }

        if ($gender) {
            $query->where('gender', $gender);
        }

        $profiles = $query->get();

        return view('home', compact('profiles'));
    }
}
