<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $gender = $request->input('gender');

        $query = Profile::query();

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
                $query->orWhere('age', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($gender) {
            $query->where('gender', $gender);
        }

        $profiles = $query->get();

        return view('home', compact('profiles'));
    }
}
