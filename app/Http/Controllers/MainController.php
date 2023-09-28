<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Menu;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    public function pageView () {

        $menu = new Menu();

        $banners = Banner::orderBy('banner_order', 'ASC')->limit(6)->get();

        return view('index', ['menu' => $menu->all(), 'banners' => $banners]);
    }
}