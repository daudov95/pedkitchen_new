<?php

namespace App\Http\Controllers;

use App\Models\CategoryMonograph;
use App\Models\Monograph;
use Illuminate\Http\Request;

class CookbookController extends Controller
{
    //

    public function monographs()
    {
        $posts = Monograph::paginate(6);
        $category = null; //CategoryMonograph::latest()->first()
        $menu = CategoryMonograph::all();

        return view("pages.cookbook.monographs", compact('posts', 'category', 'menu'));
    }

    public function categoryMonographs(CategoryMonograph $category)
    {
        $posts = Monograph::where('category_id', $category->id)->paginate(6);
        $menu = CategoryMonograph::all();

        return view("pages.cookbook.monographs", compact('posts', 'category', 'menu'));
    }

    public function monograph(Monograph $post)
    {
        $category = null;
        $menu = CategoryMonograph::all();
        return view('pages.cookbook.monographs-post', compact('post', 'category', 'menu'));
    }
}
