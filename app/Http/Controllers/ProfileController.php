<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public function pageFavorites () {

        $posts = Favorite::query()->where('user_id', auth()->id())->paginate(6);
        dd($posts);
        // $submenuList = Submenu::where('parent_id', $category)->get();
        // $currentCategory = Submenu::where('id', $submenu)->where('parent_id', $category)->first();
        // $submenu = Submenu::where('parent_id', $category)->get();
        // dd();

        return view('favorites', ['posts' => $posts, 'profile' => true]);
    }

    public function pageProfile () {

        return view('profile.profile');
    }

    public function pageSettings () {

        return view('profile.settings');
    }

}