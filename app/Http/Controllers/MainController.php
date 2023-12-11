<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Menu;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    public function pageView () {

        $menu = Menu::query()->orderBy('order')->get();

        $banners = Banner::orderBy('banner_order', 'ASC')->limit(6)->get();

        return view('index', compact('menu', 'banners'));
    }
}