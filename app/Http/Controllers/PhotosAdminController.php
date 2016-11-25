<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Image;
use App\Photo;
use App\Tag;

class PhotosAdminController extends Controller
{
    /*******************************************/
    public function upload(Request $request, $id=null)
    {
      if($request->isMethod('POST'))
      {
        if($id !== null)
        {
          $o = Photo::find((int)$id);

          if($request->photodelete)
          {
            $o->delete();
            $u1 = unlink('photos/normal/' . $o->name . '.jpg');
            $u2 = unlink('photos/medium/' . $o->name . '.jpg');
            $u3 = unlink('photos/small_color/' . $o->name . '.jpg');

            if($u1 and $u2 and $u3)
            {
              return redirect()->route('uploadphoto')->with(['message_type' => 'success', 'message_text' => 'the picture has been deleted']);
            }
            else
            {
              return redirect()->route('uploadphoto')->with(['message_type' => 'warning', 'message_text' => 'the picture has been deleted from the database, but you have to delete files from the server manually']);
            }
          }
        }
        if($id !== null)
        {
          $validation_rule_photo = 'image|mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:102400';
        }
        else
        {
          $validation_rule_photo = 'required|image|mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:102400';
        }

        $rules = [
          'phototitle' => 'max:100',
          'photodescription' => 'max:500',
          'photo' => $validation_rule_photo,
          'phototags' => 'max:100',
        ];
        $messages = [
          'required' => 'The field is required.',
          'max' => 'The field may not be greater than :max.',
          'image' => 'The file must be an image file.',
          'mimes' => 'The file must be an image file *.jpg, *.jpeg, *.JPG, *.JPEG, *.png., *.PNG',
        ];

        $this->validate($request, $rules, $messages);
          
        //////////// input text
        $title = trim($request->input('phototitle'));
        $description = trim($request->input('photodescription'));

        //////////// input photo
        if($request->hasFile('photo'))
        {
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
        }
        if($id === null)
        {
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
        }
        else
        {
          $name = $o->name;
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

        //Image::make($photo)->save('photos/normal/' . $name . '.' . 'jpg');
        if($request->hasFile('photo'))
        {
          $width = Image::make($photo)->width();
          if($width > 1920)
          {
            Image::make($photo)->resize(1920, NULL, function($e){
              $e->aspectRatio();
            })->save('photos/normal/' . $name . '.jpg');
          }
          else
          {
            Image::make($photo)->save('photos/normal/' . $name . '.' . 'jpg');
          }
          $photo_medium = Image::make($photo)->resize(NULL, 1300, function($e){
            $e->aspectRatio();
          })->save('photos/medium/' . $name . '.jpg');

          $photo_small_color = Image::make($photo)->resize(480, NULL, function($e){
            $e->aspectRatio();
          })->save('photos/small_color/' . $name . '.jpg');
        }
        
        ///////////// store in db
        if($id === null)
        {
          $o = new Photo();
        }

        $o->title = $title;
        $o->description = $description;
        if($request->hasFile('photo'))
        {
          $o->name = (string)$name;
          $o->ext = $ext;
        }
        $o->save();

        ///////////// add tags
        $photo = Photo::where('name', $name)->first();

        if($id === null)
        {
          $photo->tags()->attach($tags_ids);
        }
        else
        {
          $photo->tags()->detach();
          $photo->tags()->attach($tags_ids);
        }

        if($id === null)
        {
          return redirect()->route('uploadphoto')->with(['message_type' => 'success', 'message_text' => 'the picture has been uploaded']);
        }
        else
        {
          return redirect()->route('photoslist')->with(['message_type' => 'success', 'message_text' => 'the picture has been updated']);
        }
      }
    }

    /**************************************/
    public function updatephoto(Request $request, $id)
    {
      if($request->isMethod('GET'))
      {
        $tags = Tag::all();
        $tags_arr = array();
        foreach($tags as $tag)
        {
          $tags_arr[$tag->id] = $tag->tag;
        }
        $photo = Photo::find($request->id);

        return view('photos.uploadphoto', ['tags' => $tags, 'tags_arr' => $tags_arr, 'id' => $id, 'photo' => $photo, 'updatephoto' => true]);
      }
    }
    public function uploadphoto(request $request)
    {
        $tags = Tag::all();
        $tags_arr = array();
        foreach($tags as $tag)
        {
          $tags_arr[$tag->id] = $tag->tag;
        }   
        return view('photos.uploadphoto', ['tags' => $tags, 'tags_arr' => $tags_arr]);
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
                'required' => 'the field is required',
                'max' => 'the field may not be greater than :max characters',
            ];

            $this->validate($request, $rules, $messages);

        $tag_input = trim(strtolower($request->input('tag')));
        $ifExists = Tag::where('tag', $tag_input)->exists();

        if($ifExists)
        {
         return redirect()->route('addtag')->withInput()->with(['message_type' => 'warning', 'message_text' => 'the tag already exists in the database, insert another one']);
        }
        else
        {
          $o = new Tag();
          $o->tag = $tag_input;
          $o->save();

         return redirect()->route('addtag')->with(['message_type' => 'success', 'message_text' => 'the tag has been added to the database']);
        }
      }
    }

    /******************************************/
    public function photoslist(Request $request)
    {
      if($request->isMethod('GET'))
      {
        $tags = Tag::all();
        if(!$request->session()->exists('photos'))
        {
          $photos = Photo::orderBy('created_at', 'desc')->paginate(10);
        }
        else
        {
          $photos = $request->session()->get('photos');
        }
        return view('photos.photoslist', ['tags' => $tags, 'photos' => $photos]);
      }
    }

    /******************************************/
    public function search(Request $request)
    {
      if($request->isMethod('POST'))
      {

        $rules = [
          'search' => 'required|max:100'
        ];
        $messages = [
          'required' => 'the field is required',
          'max' => 'the field may not be greater than :max characters',
        ];
        $this->validate($request, $rules, $messages);

        $search = trim($request->search);

        $photos = Photo::where('title', 'LIKE', "%$search%")->orderBy('created_at', 'desc')->paginate(10);
        return redirect()->route('photoslist')->with('photos', $photos);
      }
    }
}
