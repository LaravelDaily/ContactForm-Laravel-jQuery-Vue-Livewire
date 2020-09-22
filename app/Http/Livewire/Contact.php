<?php

namespace App\Http\Livewire;

use App\Notifications\ContactFormNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $question;

    public $message;

    protected $rules = [
        'name' => [
            'required',
        ],
        'email' => [
            'required',
            'email',
        ],
        'question' => [
            'required'
        ],
    ];

    public function submitForm()
    {
        $this->message = '';
        $this->validate();

        Notification::route('mail', config('mail.contact_email'))
            ->notify(new ContactFormNotification([
                'name' => $this->name,
                'email' => $this->email,
                'question' => $this->question,
            ]));

        $this->name = '';
        $this->email = '';
        $this->question = '';

        $this->message = 'Email successfully sent';
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
