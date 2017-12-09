<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotosController extends Controller
{

    /************************************************/
    public function index(Request $request, $tag = null)
    {
        $previous = $request->route()->getName();
        $request->session()->put('previous', $previous);

        if ($request->isMethod('get')) {
            $photos = Photo::orderBy('created_at', 'desc')->paginate(30);
            if ($photos->count() != 0) {
                if ($tag === null) {
                    $tag_to_ajax = $tag;
                    $count = $photos->count();
                    $ratio = $count / 4;
                } else {
                    $tag_to_ajax = $tag;
                    $tag = Tag::where('tag', $tag)->first();
                    $photos = $tag->photos()->orderBy('created_at', 'desc')->paginate(30);
                    $count = $photos->count();
                    $ratio = $count / 4;
                }
            } else {
                $count = 0;
                $tag_to_ajax = null;
                $ratio = null;
            }

        }
        if ($request->ajax()) {
            if ($request->has('name')) {
                $name = $request->name;
                $all = Photo::orderBy('created_at', 'desc')->get();
                $created_at = Photo::where('name', $name)->first()->created_at;
                $tag = Tag::where('tag', $tag)->first();

                if ($request->direction === 'right') {
                    if ($tag == null) {
                        if (Photo::where('created_at', '<', $created_at)->exists()) {
                            $collection = Photo::orderBy('created_at', 'desc')->where('created_at', '<', $created_at)->first();
                        } else {
                            $collection = $all->first();
                        }
                    } else {
                        if ($tag->photos()->where('created_at', '<', $created_at)->exists()) {
                            $collection = $tag->photos()->orderBy('created_at', 'desc')->where('created_at', '<', $created_at)->first();
                        } else {
                            $collection = $tag->photos()->orderBy('created_at', 'desc')->first();
                        }
                    }
                }
                if ($request->direction === 'left') {
                    if ($tag == null) {
                        if (Photo::where('created_at', '>', $created_at)->exists()) {
                            $collection = Photo::where('created_at', '>', $created_at)->orderBy('created_at', 'asc')->first();
                        } else {
                            $collection = $all->last();
                        }
                    } else {
                        if ($tag->photos()->where('created_at', '>', $created_at)->exists()) {
                            $collection = $tag->photos()->where('created_at', '>', $created_at)->orderBy('id', 'asc')->first();
                        } else {
                            $collection = $tag->photos()->orderBy('created_at', 'asc')->first();
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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('ag-photography');
    }
    public function previous(Request $request)
    {
        if ($request->session()->exists('previous')) {
            return redirect()->route($request->session()->get('previous'));
        } else {
            return redirect()->route('ag-photography');
        }
    }
}
