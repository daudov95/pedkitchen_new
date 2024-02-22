<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cookbook\Diagnostic\StoreDiagnosticRequest;
use App\Http\Requests\Cookbook\Diagnostic\UpdateDiagnosticRequest;
use App\Models\CategoryDiagnostic;
use App\Models\Diagnostic;
use App\Services\Uploader\UploaderService;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    public function index()
    {
        $posts = Diagnostic::paginate(20);
        return view('admin.pages.cookbook.diagnostic.index', compact('posts'));
    }
    public function create()
    {
        $categories = CategoryDiagnostic::all();
        return view('admin.pages.cookbook.diagnostic.create', compact('categories'));
    }

    public function store(StoreDiagnosticRequest $request, UploaderService $uploader)
    {
        $image = $uploader->store('image/diagnostic', $request->file('image'));
        $document = $uploader->store('documents/diagnostic', $request->file('document'));

        $post = Diagnostic::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'image' => $image,
            'document' => $document,
        ]);

        session()->flash('success', "Инструментарий успешно создан!");
        return redirect()->route('admin.cookbook.diagnostic.all');
    }

    public function edit(int $id)
    {
        $post = Diagnostic::find($id);
        $categories = CategoryDiagnostic::all();
        return view('admin.pages.cookbook.diagnostic.edit', compact('post', 'categories'));
    }

    public function update(UpdateDiagnosticRequest $request, UploaderService $uploader)
    {
        $post = Diagnostic::find($request->id);
        $data = [...collect($request->validated())->only(['title', 'category_id'])->toArray()];

        if($request->hasFile('image')) {
            if($post->image) {
                $uploader->delete($post->image);
            }

            $image = $uploader->store('image/diagnostic', $request->file('image'));
            $data['image'] = $image;
        }

        if($request->hasFile('document')) {
            if($post->document) {
                $uploader->delete($post->document);
            }

            $document = $uploader->store('documents/diagnostic', $request->file('document'));
            $data['document'] = $document;
        }
        
        $post->update($data);

        session()->flash('success', "Инструментарий успешно обновлен!");
        return back();
    }


    public function delete(Request $request, UploaderService $uploader)
    {
        $post = Diagnostic::find($request->id);


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
