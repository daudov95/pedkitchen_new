<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactFormRequest;
use App\Mail\QuestionResponse;
use App\Models\Consultant;
use App\Models\ContactForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

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

        if($request->authors == '0' && $request->topic_select == '1') {
            return throw ValidationException::withMessages([
                'message' => 'Выберите консультанта',
            ]);
        }

        if($request->authors != '0') {
            $consultant = Consultant::find($request->authors);
            $topic = 'Консультация - '.$consultant->name;
        } else {
            $topic = $request->topic;
        }
        

        $req = ContactForm::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'topic' => $topic,
            'message' => $request->message,
            'topic_select' => $request->topic_select,
        ]);

        if($req->exists) {
            return redirect()->back()->with('success', 'Вы успешно отправили форму, дождитесь ответа на почту.');
        }

        return redirect()->back()->with('error', 'Ошибка при отправке данных');
    }
}
