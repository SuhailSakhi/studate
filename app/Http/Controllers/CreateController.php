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
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:18|max:30',
        ], [
            'image.required' => 'De afbeelding is verplicht.',
            'image.image' => 'De afbeelding moet een geldig afbeeldingsbestand zijn (jpeg, png, jpg, gif).',
            'image.mimes' => 'De afbeelding moet van het type jpeg, png, jpg of gif zijn.',
            'image.max' => 'De afbeelding mag niet groter zijn dan 2 MB.',
            'name.required' => 'De naam is verplicht.',
            'name.max' => 'De naam mag niet langer zijn dan 255 tekens.',
            'bio.required' => 'De bio is verplicht.',
            'gender.required' => 'Het geslacht is verplicht.',
            'gender.in' => 'Het geslacht moet man, vrouw of anders zijn.',
            'age.required' => 'De leeftijd is verplicht.',
            'age.integer' => 'De leeftijd moet een getal zijn.',
            'age.min' => 'De leeftijd moet minimaal 18 jaar zijn.',
            'age.max' => 'De leeftijd mag niet ouder zijn dan 30 jaar.',
        ]);


//        if ($validator->fails()) {
//            return redirect()->back()
//                ->withErrors($validator)
//                ->withInput();
            if ($validator->fails()) {
                return redirect()->route('create')
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

