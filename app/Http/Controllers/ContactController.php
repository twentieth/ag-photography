<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\My\Objects\Mail as MyMail;
use App\Tag;

class ContactController extends Controller
{
    public function contactForm(Request $request)
    {
        $previous = $request->route()->getName();
        $request->session()->put('previous', $previous);
        $contact = new \App\Contact();
        $tags = Tag::all();

        return view('photos.contact', ['tags' => $tags, 'contact' => $contact]);

    }

    public function contactSend(Request $request)
    {
        $contact = new \App\Contact();

        $this->validate($request, $contact->getRules(), $contact->getMessages());

        $contact->name = $request->name;
        $contact->mail = $request->mail;
        $contact->message = $request->message;
        $contact->cc_myself = $request->cc_myself;
        $myMail = (new MyMail())->setView('contact');

        if ($contact->save()) {
            if ($contact->cc_myself) {
                $myMail->addCc($contact->mail);
            }
            $myMail->send($contact, 'contact');
        }

        return redirect()->route('contactForm')->with(['message_type' => 'info', 'message_text' => 'thank you, the message has been sent']);

    }
}
