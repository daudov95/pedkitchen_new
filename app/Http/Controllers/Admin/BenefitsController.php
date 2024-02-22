<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cookbook\Benefits\StoreBenefitRequest;
use App\Http\Requests\Cookbook\Benefits\UpdateBenefitRequest;
use App\Models\Author;
use App\Models\Benefit;
use App\Models\CategoryBenefit;
use App\Services\Uploader\UploaderService;
use Illuminate\Http\Request;

class BenefitsController extends Controller
{
    public function index()
    {
        $posts = Benefit::paginate(20);
        $authors = Author::all();
        return view('admin.pages.cookbook.benefits.index', compact('posts'));
    }
    public function create()
    {
        $categories = CategoryBenefit::all();
        $authors = Author::all();
        return view('admin.pages.cookbook.benefits.create', compact('categories', 'authors'));
    }

    public function store(StoreBenefitRequest $request, UploaderService $uploader)
    {
        $image = $uploader->store('image/benefits', $request->file('image'));
        $document = $uploader->store('documents/benefits', $request->file('document'));

        $post = Benefit::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'image' => $image,
            'document' => $document,
        ]);
        $post->authors()->attach($request->authors);

        session()->flash('success', "Пособия успешно создана!");
        return redirect()->route('admin.cookbook.benefits.all');
    }

    public function edit(int $id)
    {
        $post = Benefit::find($id);
        $categories = CategoryBenefit::all();
        $authors = Author::all();
        return view('admin.pages.cookbook.benefits.edit', compact('post', 'categories', 'authors'));
    }

    public function update(UpdateBenefitRequest $request, UploaderService $uploader)
    {
        $post = Benefit::find($request->id);
        $data = [...collect($request->validated())->only(['title', 'category_id'])->toArray()];

        if($request->hasFile('image')) {
            if($post->image) {
                $uploader->delete($post->image);
            }

            $image = $uploader->store('image/benefits', $request->file('image'));
            $data['image'] = $image;
        }

        if($request->hasFile('document')) {
            if($post->document) {
                $uploader->delete($post->document);
            }

            $document = $uploader->store('documents/benefits', $request->file('document'));
            $data['document'] = $document;
        }
        
        $post->update($data);
        $post->authors()->sync($request->authors);

        session()->flash('success', "Пособия успешно обновлена!");
        return back();
    }


    public function delete(Request $request, UploaderService $uploader)
    {
        $post = Benefit::find($request->id);


        if($post) {
            $uploader->delete($post->image);
            $uploader->delete($post->document);
            $post->delete();
            session()->flash('success', "Инструментарий успешно удален!");

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
