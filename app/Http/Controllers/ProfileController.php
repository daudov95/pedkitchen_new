<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //

    public function pageFavorites () {

        $posts = Auth::user()->favorites()->orderByPivot('id', 'DESC')->paginate(6);

        return view('favorites', ['posts' => $posts, 'profile' => true]);
    }

    public function pageProfile () {

        return view('profile.profile', ['profile' => true]);
    }

    public function pageSettings () {

        return view('profile.settings', ['profile' => true]);
    }

}