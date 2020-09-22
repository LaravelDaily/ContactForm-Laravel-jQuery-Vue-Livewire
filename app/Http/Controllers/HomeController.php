<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Notifications\ContactFormNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function submit(ContactRequest $request)
    {
        Notification::route('mail', config('mail.contact_email'))
                    ->notify(new ContactFormNotification($request->only(['name', 'email', 'question'])));

        return response()->noContent();
    }

    public function postContact(ContactRequest $request)
    {
        Notification::route('mail', config('mail.contact_email'))
            ->notify(new ContactFormNotification($request->only(['name', 'email', 'question'])));

        return back()->withMessage('Email successfully sent');
    }
}
