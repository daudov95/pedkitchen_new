<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cookbook\Monographs\StoreMonographsRequest;
use App\Http\Requests\Cookbook\Monographs\UpdateMonographsRequest;
use App\Models\Author;
use App\Models\CategoryMonograph;
use App\Models\Monograph;
use App\Services\Uploader\UploaderService;
use Illuminate\Http\Request;

class MonographsController extends Controller
{
    //
    public function index()
    {
        $posts = Monograph::paginate(20);
        return view('admin.pages.cookbook.monograph.index', compact('posts'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = CategoryMonograph::all();
        return view('admin.pages.cookbook.monograph.create', compact('authors', 'categories'));
    }

    public function store(StoreMonographsRequest $request, UploaderService $uploader)
    {
        // dd($request->all());
        $image = $uploader->store('image/monographs', $request->file('image'));
        $document = $uploader->store('documents/monographs', $request->file('document'));

        $post = Monograph::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'year' => $request->year,
            'category_id' => $request->category_id,
            'image' => $image,
            'document' => $document,
        ]);
        $post->authors()->attach($request->authors);

        session()->flash('success', "Монография успешно создана!");
        return redirect()->route('admin.cookbook.monographs.all');
    }

    public function edit(int $id)
    {
        $post = Monograph::with('authors')->find($id);
        $authors = Author::all();
        $categories = CategoryMonograph::all();
        return view('admin.pages.cookbook.monograph.edit', compact('post', 'authors', 'categories'));
    }

    public function update(UpdateMonographsRequest $request, UploaderService $uploader)
    {
        $post = Monograph::find($request->id);
        $data = [...collect($request->validated())->only(['title', 'desc', 'year', 'category_id'])->toArray()];

        if($request->hasFile('image')) {
            if($post->image) {
                $uploader->delete($post->image);
            }

            $image = $uploader->store('image/monographs', $request->file('image'));
            $data['image'] = $image;
        }

        if($request->hasFile('document')) {
            if($post->document) {
                $uploader->delete($post->document);
            }

            $document = $uploader->store('documents/monographs', $request->file('document'));
            $data['document'] = $document;
        }
        
        $post->update($data);
        $post->authors()->sync($request->authors);

        session()->flash('success', "Монография успешно обновлена!");
        return back();
    }


    public function delete(Request $request, UploaderService $uploader)
    {
        $post = Monograph::find($request->id);


        if($post) {
            $uploader->delete($post->document);
            $post->delete();
            session()->flash('success', "Монограф успешно удален!");

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
