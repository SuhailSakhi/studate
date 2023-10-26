<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function create(): \Illuminate\View\View
    {
        return view('create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:18|max:30',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = $request->file('image')->store('/images', 'public');
        $imagePath = str_replace('images/', '', $imagePath);

        Profile::create([
            'user_id' => $user->id,
            'image' => $imagePath,
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'bio' => $request->input('bio'),
        ]);

        return redirect()->route('home')->with('success', 'Profiel aangemaakt!');
    }

}

