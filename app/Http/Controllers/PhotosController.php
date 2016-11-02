<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use App\Tag;

class PhotosController extends Controller
{
    public function photoslist(Request $request)
    {
    	$photos = Photo::all();

    	return view('photos.photoslist', ['photos' => $photos]);
    }
    public function photo($id)
    {
    	$o = Photo::find($id);
		$name = $o->name;
		$ext = $o->ext;
		return view('photos.photoview', ['name' => $name, 'ext' => $ext]);
    }
    public function index()
    {
        $photos = Photo::all();
        $count = count($photos) / 3;
        $count = (int)$count;
        return view('photos.index', ['photos' => $photos, 'count' => $count]);
    }
    public function contact(Request $request)
    {
        if($request->isMethod('GET'))
        {
            return view('photos.contact');
        }
        if($request->isMethod('POST'))
        {
            $rules = [
                'your_name' => 'required|max:100',
                'your_email' => 'required|max:255|email',
                'your_message' => 'required|max:500',
            ];
            $messages = [
                'required' => 'The field is required.',
                'max' => 'The field may not be greater than :max characters.',
                'email' => 'The field must be formatted as an e-mail address.',
            ];

            $this->validate($request, $rules, $messages);
            

            return redirect()->route('contact');
        }
    }
}
