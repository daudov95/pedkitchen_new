<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Category;
use App\Models\Submenu;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Get all posts
    public function allPosts ($category) {
        $section = Menu::find($category);

        if(!$section) {
            return abort(404);
        }

        $posts = $section->posts()->paginate(6);
        $submenu = Submenu::where('parent_id', $category)->get();

        // dd(Menu::find($category)->posts()->paginate(6));
        return view('posts', ['posts' => $posts, 'menu' => $submenu, 'parentCategory' => $category]);
    }

    // Get category posts
    public function categoryPosts ($category, $submenu) {

        $posts = Post::where('submenu_id', $submenu)->where('menu_id', $category)->paginate(6);
        $submenuList = Submenu::where('parent_id', $category)->get();
        $currentCategory = Submenu::where('id', $submenu)->where('parent_id', $category)->first();

        // dd($submenuList);

        return view('posts', ['posts' => $posts, 'menu' => $submenuList, 'category' => $currentCategory, 'parentCategory' => $category]);
    }

    // Get single post
    public function singlePost ($menu, $subcategory, $post) {

        $post = Post::find($post);
        $category = Category::where('id', $post->category_id)->first();
        $submenuList = Submenu::where('parent_id', $menu)->get();
        // dd($post->category_id);

        return view('post', ['post' => $post, 'category' => $category, 'parentCategory' => $menu, 'menu' => $submenuList]); // 'author' => $author,
    }

    // Get single free post
    public function singlePostFree ($post) {

        $menu = 13;
        $post = Post::find($post);
        $category = Category::where('id', $post->category_id)->first();
        $submenuList = Submenu::where('parent_id', $menu)->get();

        return view('post', ['post' => $post, 'category' => $category, 'parentCategory' => $menu, 'menu' => $submenuList]); // 'author' => $author,
    }


}
