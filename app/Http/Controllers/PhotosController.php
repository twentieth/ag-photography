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
}
