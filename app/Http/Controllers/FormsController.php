<?php

namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use App\Http\Requests;
  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\Controller;
  use Image;
  use App\Photo;
  use App\Tag;

  class FormsController extends Controller
  {
    public function uploadphoto(Request $request)
    {
      if($request->isMethod('GET'))
      {
        $tags = Tag::all();
        return view('photos.uploadphoto', ['tags' => $tags]);
      }
      if($request->isMethod('POST'))
      {
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
            if($ext === 'jpeg')
            {
              $ext = 'jpg';
            }
            $name = rand();
            while(True)
            {
              $ifExists = Photo::where('name', $name)->exists();
              if($ifExists)
              {
                $name = rand();
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

            Image::make($photo)->save('../storage/app/public/photos/normal/' . $name . '.' . $ext);
            $photo_medium = Image::make($photo)->resize(NULL, 500, function($e){
              $e->aspectRatio();
            })->save('../storage/app/public/photos/medium/' . $name . '.jpg');

            $photo_small_color = Image::make($photo)->resize(NULL, 150, function($e){
              $e->aspectRatio();
            })->save('../storage/app/public/photos/small_color/' . $name . '.jpg');

            $photo_small_bw = Image::make($photo)->resize(NULL, 150, function($e){
             $e->aspectRatio();
            })->greyscale()->save('../storage/app/public/photos/small_bw/' . $name . '.jpg');
        
            ///////////// store in DB
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
            return redirect()->route('uploadphoto')->withInput()->with(['message_type' => 'warning', 'message_text' => 'Załączony plik jest nieprawidłowy.']);
          }
        }
        else
        {
          return redirect()->route('uploadphoto')->withInput()->with(['message_type' => 'warning', 'message_text' => 'Załącz plik.']);
        }
      }
    }
    public function addtag(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view('photos.addtag');
      }
      if($request->isMethod('POST'))
      {
        $tag_input = trim(strtolower($request->input('tag')));
        $ifExists = Tag::where('tag', $tag_input)->exists();
        if($ifExists)
        {
         return redirect()->route('addtag')->withInput()->with(['message_type' => 'warning', 'message_text' => 'Podana nazwa już istnieje w bazie danych. Wprowadź inną.']);
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


?>