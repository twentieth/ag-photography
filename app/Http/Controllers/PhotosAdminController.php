<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Image;
use App\Photo;
use App\Tag;

class PhotosAdminController extends Controller
{
    /*******************************************/
    public function uploadphoto(Request $request)
    {
      if($request->isMethod('GET'))
      {
        $tags = Tag::all();
        $tags_arr = array();
  		foreach($tags as $tag)
  		{
    		$tags_arr[$tag->id] = $tag->tag;
  		}		
        return view('photos.uploadphoto', ['tags' => $tags, 'tags_arr' => $tags_arr]);
      }
      if($request->isMethod('POST'))
      {
      	$rules = [
                'phototitle' => 'max:100',
                'photodescription' => 'max:500',
                'photo' => 'required|image|mimes:jpeg,jpg,png,JPG,JPEG|max:102400',
                'phototags' => 'max:100',
            ];
            $messages = [
                'required' => 'The field is required.',
                'max' => 'The field may not be greater than :max.',
                'image' => 'The file must be an image file.',
                'mimes' => 'The file must be an image file *.jpg, *.jpeg, *.JPG, *.JPEG, *.png.',
            ];

            $this->validate($request, $rules, $messages);
        if($request->hasFile('photo'))
        {

          if($request->file('photo')->isValid())
          {
            //////////// input text
            $title = trim($request->input('phototitle'));
            $ifExists = Photo::where('title', $title)->exists();
            if($ifExists)
            {
              return redirect()->route('uploadphoto')->withInput()->with(['message_type' => 'warning', 'text' => 'Zmień tytuł.']);
            }
            $description = trim($request->input('photodescription'));

            //////////// input photo
            $photo = $request->file('photo');
            $ext = $photo->extension();
            if($ext === 'jpeg' || $ext === 'JPG' || $ext === 'JPEG')
            {
              $ext = 'jpg';
            }
            function randomStringFromFigures($x)
                {
                  $str = '';
                  for($i=0;$i<$x;$i++)
                  {
                    $str .= (string)rand(0, 9);
                  }
                  return $str;
                }
            $name = randomStringFromFigures(10);
            while(True)
            {
              $ifExists = Photo::where('name', $name)->exists();
              if($ifExists)
              {
                $name = randomStringFromFigures(10);
                continue;
              }
              else
              {
                break;
              }
            }

            $tags_ids = array();
            $tags_objects = array();
            $tags_input = $request->input('phototags');
            for($i=0; $i<count($tags_input); $i++)
            {
             $val = (int)$tags_input[$i];
             $tags_objects[$i] = Tag::find($val);
             $tags_ids[] = $tags_objects[$i]->id;
            }

            Image::make($photo)->save('photos/normal/' . $name . '.' . 'jpg');
            $photo_medium = Image::make($photo)->resize(NULL, 700, function($e){
              $e->aspectRatio();
            })->save('photos/medium/' . $name . '.jpg');

            $photo_small_color = Image::make($photo)->resize(500, NULL, function($e){
              $e->aspectRatio();
            })->save('photos/small_color/' . $name . '.jpg');

            //$photo_small_bw = Image::make($photo)->resize(NULL, 500, function($e){
             //$e->aspectRatio();
            //})->greyscale()->save('photos/small_bw/' . $name . '.jpg');
        
            ///////////// store in db
            $o = new Photo();
            $o->title = $title;
            $o->description = $description;
            $o->name = (string)$name;
            $o->ext = $ext;

            $o->save();

            ///////////// add tags
            $photo = Photo::where('name', $name)->first();
            $photo->tags()->attach($tags_ids);


            return redirect()->route('uploadphoto')->with(['message_type' => 'success', 'message_text' => 'Photo has been uploaded.']);
          }
          else
          {
            return redirect()->route('uploadphoto')->with(['message_type' => 'warning', 'message_text' => 'Załączony plik jest nieprawidłowy.']);
          }
        }
        else
        {
          return redirect()->route('uploadphoto')->with(['message_type' => 'warning', 'message_text' => 'Załącz plik.']);
        }
      }
    }

    /**************************************/
    public function addtag(Request $request)
    {
      if($request->isMethod('GET'))
      {
        $tags = Tag::all();
        return view('photos.addtag', ['tags' => $tags]);
      }
      if($request->isMethod('POST'))
      {
      	$rules = [
                'tag' => 'required|max:100',
            ];
            $messages = [
                'required' => 'The field is required.',
                'max' => 'The field may not be greater than :max characters.',
            ];

            $this->validate($request, $rules, $messages);

        $tag_input = trim(strtolower($request->input('tag')));
        $ifExists = Tag::where('tag', $tag_input)->exists();

        if($ifExists)
        {
         return redirect()->route('addtag')->withInput()->with(['message_type' => 'warning', 'message_text' => 'Podany tag już istnieje w bazie danych. Wprowadź inny.']);
        }
        else
        {
          $o = new Tag();
          $o->tag = $tag_input;
          $o->save();

         return redirect()->route('addtag')->with(['message_type' => 'success', 'message_text' => 'Tag został dodany do bazy danych.']);
        }
      }
    }
}
