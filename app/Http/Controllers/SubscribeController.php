<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeRequest;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    //
    public function pageView(Request $request, $menu) {

        $data = ['menu_id' => $menu];

        if(Auth::check()) {
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
        }
        // dd($category);
        return view('subscribe', compact('data'));
    }

    public function subscribe(StoreSubscribeRequest $request) {

        // dd($request->all());

        $newSubscriber = Subscriber::create([
            'name' => $request->name,
            'email' => $request->email,
            'menu_id' => $request->menu_id,
        ]);

        session()->flash('success', 'Вы успешно подписались на рассылку');

        if(!$newSubscriber) {
            dd($newSubscriber);
        }

        return redirect()->back();
    }
}