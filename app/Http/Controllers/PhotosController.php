<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Photo;
use App\Tag;
use App\User;


class PhotosController extends Controller
{

    /************************************************/
    public function index(Request $request, $tag=null)
    {
        $previous = $request->route()->getName();
        $request->session()->put('previous', $previous);
        
        if($request->isMethod('GET'))
        {
            $photos = Photo::orderBy('created_at', 'DESC')->get();
            if($photos->count() != 0)
            {
                if($tag === null)
                {
                    $tag_to_ajax = $tag;
                    $count = $photos->count();
                    $ratio = $count / 4;
                }
                else
                {
                    $tag_to_ajax = $tag;
                    $tag = Tag::where('tag', $tag)->first();
                    $photos = $tag->photos()->orderBy('created_at', 'DESC')->get();
                    $count = $photos->count();
                    $ratio = $count / 4;
                }
            }
            else
            {
                $count = 0;
                $tag_to_ajax = null;
                $ratio = null;
            }
            
        }
        if($request->ajax())
        {
            if($request->has('name'))
            {
                $name = $request->name;
                $all = Photo::orderBy('created_at', 'DESC')->get();
                $created_at = Photo::where('name', $name)->first()->created_at;
                $tag = Tag::where('tag', $tag)->first();

                if($request->direction === 'right')
                {
                    if($tag == null)
                    {
                        if(Photo::where('created_at', '<', $created_at)->exists())
                        {
                            $collection = Photo::orderBy('created_at', 'DESC')->where('created_at', '<', $created_at)->first();
                        }
                        else
                        {
                            $collection = $all->first();
                        }
                    }
                    else
                    {
                        if($tag->photos()->where('created_at', '<', $created_at)->exists())
                        {
                            $collection = $tag->photos()->orderBy('created_at', 'DESC')->where('created_at', '<', $created_at)->first();
                        }
                        else
                        {
                            $collection = $tag->photos()->orderBy('created_at', 'DESC')->first();
                        }
                    }
                }
                if($request->direction === 'left')
                {
                    if($tag == null)
                    {
                        if(Photo::where('created_at', '>', $created_at)->exists())
                        {
                            $collection = Photo::where('created_at', '>', $created_at)->orderBy('created_at', 'ASC')->first();
                        }
                        else
                        {
                            $collection = $all->last();
                        }
                    }
                    else
                    {
                        if($tag->photos()->where('created_at', '>', $created_at)->exists())
                        {
                            $collection = $tag->photos()->where('created_at', '>', $created_at)->orderBy('id', 'ASC')->first();
                        }
                        else
                        {
                            $collection = $tag->photos()->orderBy('created_at', 'ASC')->first();
                        }
                    }
                }
                $tags = '';
                foreach ($collection->tags as $tag) {
                    $tags .= $tag->tag . ' ';
                }
                $tags = trim($tags);
                return response()->json(['title' => $collection->title, 'name' => $collection->name, 'description' => $collection->description, 'tags' => $tags]);
            }
        }
        $tags = Tag::all();
        return view('photos.index', ['photos' => $photos, 'count' => $count, 'ratio' => $ratio, 'tags' => $tags, 'tag_to_ajax' => $tag_to_ajax]);
    }

    /***************************************/
    public function contact(Request $request)
    {
        $previous = $request->route()->getName();
        $request->session()->put('previous', $previous);
        
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
                'required' => 'the field is required',
                'max' => 'the field may not be greater than :max characters',
                'email' => 'the field must be formatted as an e-mail address',
            ];

            $this->validate($request, $rules, $messages);

            $name = trim($request->your_name);
            $from = trim($request->your_email);
            $message = trim($request->your_message);
            $mail_content = <<<EOT
Wiadomość od: $name ($from)

$message
EOT;
            $mail_content = str_replace("\n", "<br>", $mail_content);

            $mail_headers = "Content-Type: text/html; charset=UTF-8";
            if($request->cc_myself)
            {
                $to = 'twentiethsite@linux.pl, ' . $from;
            }
            else
            {
                $to = 'twentiethsite@linux.pl';
            }
            $mail = mail($to, '[[ AG-PHOTOGRAPHY ]]', $mail_content, $mail_headers);
            
            if($mail)
            {
                return redirect()->route('contact')->with(['message_type' => 'info', 'message_text' => 'thank you, the message has been sent']);
            }
            else
            {
                return redirect()->route('contact')->with(['message_type' => 'warning', 'message_text' => "i'm sorry, the message may not be sent, please try again later"]);
            }
        }
    }

    public function logout()
    {
      Auth::logout();
      return redirect()->route('ag-photography');
    }
    public function previous(Request $request)
    {
      if($request->session()->exists('previous'))
      {
        return redirect()->route($request->session()->get('previous'));
      }
      else
      {
        return redirect()->route('ag-photography');
      }
    }
}
