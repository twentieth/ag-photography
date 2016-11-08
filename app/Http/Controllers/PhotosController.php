<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use App\Tag;
use Illuminate\Support\Facades\Mail;

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

    /************************************************/
    public function index(Request $request, $tag=null)
    {
        if($request->isMethod('GET'))
        {
            if($tag === null || !isset($tag))
            {
                $photos = Photo::all();
                $count = count($photos) / 3;
                $count = (int)$count;
            }
            else
            {
                $tag = Tag::where('tag', $tag)->first();
                $photos = $tag->photos;
                $count = count($photos) / 3;
                $count = (int)$count;
            }
        }
        if($request->isMethod('POST'))
        {
            if($request->has('name'))
            {
                $name = $request->name;
                $all = Photo::all();
                $id = Photo::where('name', $name)->first()->id;

                if($request->direction === 'right')
                {
                    if(Photo::where('id', '>', $id)->exists())
                    {
                        $collection = Photo::where('id', '>', $id)->first();
                    }
                    else
                    {
                        $collection = $all->first();
                    }
                }
                if($request->direction === 'left')
                {
                    if(Photo::where('id', '<', $id)->exists())
                    {
                        $collection = Photo::where('id', '<', $id)->orderBy('id', 'desc')->first();
                    }
                    else
                    {
                        $collection = $all->last();
                    }
                }
                return response()->json(['title' => $collection->title, 'name' => $collection->name, 'description' => $collection->description]);
            }
        }
        $tags = Tag::all();
        return view('photos.index', ['photos' => $photos, 'count' => $count, 'tags' => $tags]);
    }

    /***************************************/
    public function contact(Request $request)
    {
        if($request->isMethod('GET'))
        {
            $tags = Tag::all();
            return view('photos.contact', ['tags' => $tags]);
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

            $name = trim($request->your_name);
            $from = trim($request->your_email);
            $message = trim($request->your_message);
            $use = ['from' => $from, 'name' => $name];

            if($request->cc_myself)
            {
                Mail::send('photos.contact', ['content' => $message], function($message) use ($from, $name){
                    $message->from('twentiethsite@linux.pl', '[[PHOTOS]]')->to('twentiethsite@linux.pl')->replyTo($from)->subject($name . 'from [[PHOTOS]]');
                });
            }
            else
            {
                Mail::send('photos.contact', ['content' => $message], function($message) use ($from, $name){
                    $message->from('twentiethsite@linux.pl', '[[PHOTOS]]')->to('twentiethsite@linux.pl')->subject($name . 'from [[PHOTOS]]');
                });
            }
            
            
            
            return redirect()->route('contact');
        }
    }
}
