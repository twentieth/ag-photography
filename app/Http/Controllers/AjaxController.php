<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AjaxController extends Controller
{
    public function showphoto(Request $request)
    {
    	if($request->isMethod('POST'))
    	{
    		$response_data = array();
    		$response_data['title'] = $request->title;
    		$response_data['description'] = $request->input('description');
    		if($request->hasFile('photo'))
    		{
    			$photo = $request->file('photo');
    			$response_data['path'] = $photo->store('imgs');
    			$response_data['originalName'] = $photo->getClientOriginalName();
    		}
    		


    		return response()->json($response_data);
    	}
    }
    public function showphotowithajax(Request $request)
    {
        if($request->isMethod('POST'))
        {
            
        }
    }
}
