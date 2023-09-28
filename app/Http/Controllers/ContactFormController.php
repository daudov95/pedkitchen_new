<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactFormRequest;
use App\Models\Consultant;
use App\Models\ContactForm;

class ContactFormController extends Controller
{
    //

    public function index ()
    {
        $consultants = Consultant::all();
        // dd(count($consultants));
        return view('contactform', compact('consultants')); 
    }

    public function sendForm (StoreContactFormRequest $request) 
    {
        // dd($request->all());
        $consultant = Consultant::find($request->authors);

        $topic = $request->topic_select == 2 ? $request->topic : 'Консультация - '.$consultant->name;

        $req = ContactForm::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'topic' => $topic,
            'message' => $request->message,
            'topic_select' => $request->topic_select,
        ]);

        if($req) {
            return redirect()->back()->with('success', 'Вы успешно отправили форму, дождитесь ответа на почту.');
        }

        return redirect()->back()->with('error', 'Ошибка при отправке данных');
    }
}
