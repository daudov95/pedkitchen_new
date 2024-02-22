<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\CategoryBenefit;
use App\Models\CategoryDiagnostic;
use App\Models\CategoryMonograph;
use App\Models\Diagnostic;
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


    public function diagnostic()
    {
        $posts = Diagnostic::paginate(6);
        $category = null;
        $menu = CategoryDiagnostic::all();

        return view("pages.cookbook.diagnostic.all", compact('posts', 'category', 'menu'));
    }

    public function diagnosticShow(Diagnostic $post)
    {
        $category = null;
        $menu = CategoryDiagnostic::all();

        return view("pages.cookbook.diagnostic.post", compact('post', 'category', 'menu'));
    }

    public function categoryDiagnostic(CategoryDiagnostic $category)
    {
        $posts = Diagnostic::where('category_id', $category->id)->paginate(6);
        $menu = CategoryDiagnostic::all();

        return view("pages.cookbook.diagnostic.all", compact('posts', 'category', 'menu'));
    }
    

    public function benefits()
    {
        $posts = Benefit::paginate(6);
        $category = null;
        $menu = CategoryBenefit::all();

        return view("pages.cookbook.benefits.all", compact('posts', 'category', 'menu'));
    }

    public function benefitsShow(Benefit $post)
    {
        $category = null;
        $menu = CategoryBenefit::all();

        return view("pages.cookbook.benefits.post", compact('post', 'category', 'menu'));
    }

    public function categoryBenefits(CategoryBenefit $category)
    {
        $posts = Benefit::where('category_id', $category->id)->paginate(6);
        $menu = CategoryBenefit::all();

        return view("pages.cookbook.benefits.all", compact('posts', 'category', 'menu'));
    }
}
