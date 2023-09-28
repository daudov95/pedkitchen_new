<?php

namespace App\View\Composers;

use App\Models\ContactForm;
use Illuminate\View\View;

class AdminNotificationsComposer
{
    public function compose(View $view)
    {
        $questions_count = ContactForm::query()->where('status', 0)->get()->count();
        return $view->with('questions_count', $questions_count);
    }
}