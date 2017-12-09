<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $rules = [
        'name' => 'required|max:255',
        'mail' => 'required|max:255|email',
        'message' => 'required|max:1000',
        'g-recaptcha-response' => 'required|captcha',
    ];
    protected $messages = [
        'required' => 'the field is required',
        'max' => 'the field may not be greater than :max characters',
        'mail' => 'the field must be formatted as an e-mail address',
        'captcha' => 'captcha error, try again later or contact site admin',
    ];

    public function getRules()
    {
        return $this->rules;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
