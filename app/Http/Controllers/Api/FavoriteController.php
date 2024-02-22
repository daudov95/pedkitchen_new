<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    private $add_message_success = 'Пост успешно добавлен в избранное';
    private $add_message_error = 'Ошибка при добавлении в избранное';
    private $add_message_exist = 'Пост уже добавлен в избранное';

    private $remove_message_success = 'Пост успешно удален из избранного';
    private $remove_message_error = 'Ошибка при удалени из избранного';


    public function addToFavorite(Request $request)
    {
        $post = Post::find($request->post_id);
        if(!$post->exists()) {
            return response()->json(['status' => false, 'message' => $this->add_message_error]);
        }

        $user = User::find($request->user_id);
        if(!$user->exists()) {
            return response()->json(['status' => false, 'message' => $this->add_message_error]);
        }

        $newPost = Favorite::where('post_id', $post->id)->where('user_id', $user->id);
        if($newPost->exists()) {
            return response()->json(['status' => false, 'message' => $this->add_message_exist]);
        }
        Favorite::create(['post_id' => $post->id, 'user_id' => $user->id]);
        
        return response()->json(['status' => true, 'message' => $this->add_message_success]);
    }

    public function removeFromFavorite(Request $request)
    {
        $user = User::find($request->user_id);
        if(!$user->exists()) {
            return response()->json(['status' => false, 'message' => $this->remove_message_error]);
        }

        $post = Favorite::where('post_id', $request->post_id)->where('user_id', $user->id);
        if(!$post->exists()) {
            return response()->json(['status' => false, 'message' => $this->remove_message_error]);
        }

        $post->delete();        
        return response()->json(['status' => true, 'message' => $this->remove_message_success]);
    }
}
