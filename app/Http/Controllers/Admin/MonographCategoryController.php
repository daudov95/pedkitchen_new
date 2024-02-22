<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cookbook\Monographs\Category\StoreMonographCategoryRequest;
use App\Http\Requests\Cookbook\Monographs\Category\UpdateMonographCategoryRequest;
use App\Models\CategoryMonograph;
use Illuminate\Http\Request;

class MonographCategoryController extends Controller
{
    public function index()
    {
        $posts = CategoryMonograph::paginate(6);
        return view('admin.pages.cookbook.monograph.category.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.pages.cookbook.monograph.category.create');
    }

    public function store(StoreMonographCategoryRequest $request)
    {
        CategoryMonograph::create($request->validated());

        session()->flash('success', "Категория успешно создана!");
        return redirect()->route('admin.cookbook.monographs.category');
    }

    public function edit(CategoryMonograph $post)
    {
        return view('admin.pages.cookbook.monograph.category.edit', compact('post'));
    }

    public function update(UpdateMonographCategoryRequest $request)
    {
        $post = CategoryMonograph::find($request->id);
        $post->update($request->validated());

        session()->flash('success', "Категория успешно обновлена!");
        return back();
    }


    public function delete(Request $request)
    {
        $post = CategoryMonograph::find($request->id);

        if($post) {
            $post->delete();
            session()->flash('success', "Категория успешно удалена!");

            return response()->json([
                'status' => true,
            ],200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ],404);
    }
}
