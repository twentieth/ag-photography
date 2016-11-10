<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;

  use App\Http\Requests;
  use App\Photo;
  use App\Tag;

	#namespace App\Http\Controllers;

	#use Illuminate\Support\Facades\DB;
	#use App\Http\Controllers\Controller;

	class TestController extends Controller
	{
		public function sessions(Request $request)
    	{
      		//$request->session()->flash('info', 'To jest odpowiednik framworka messages w Django.');
      		return view('test');
    	}
    	public function test(Request $request)
    	{
    		$tag = Tag::where('tag', 'krajobraz')->first();
                            $collection = $tag->photos;
                            $collection = $collection->where('id', '>', 1);
    		return $collection;
    	}
	}


?>