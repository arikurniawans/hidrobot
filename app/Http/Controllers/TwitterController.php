<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;
use Twitter;

class TwitterController extends Controller
{
    //
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'posting' => 'required'

    	],
    	[
    		'posting.required' => 'Kolom posting harus di isi !',
    	]
    	);

    	if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {
            $postTweet =  Twitter::postTweet([
            									'status' =>  $request->input('posting'),
            									'response_format' => 'json'
            								]);

            if($postTweet)
            {
            	return response()->json([
                    'success' => true,
                    'message' => 'Tweet berhasil di posting!',
                ], 200);
            }
        }

    }

    public function storemedia(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'posting' => 'required',
    		'media' => 'required'

    	],
    	[
    		'posting.required' => 'Kolom posting harus di isi !',
    		'media.required' => 'Kolom media harus di isi !',
    	]
    	);

    	if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $resorce       = $request->file('media');
            $name   = $resorce->getClientOriginalName();
            $upload = $resorce->move(\base_path() ."/public/images", $name);


            $uploaded_media = Twitter::uploadMedia(['media' => File::get(\base_path() ."/public/images/".$name)]);
			$tweetMedia = Twitter::postTweet([
													'status' => $request->input('posting'),
													'media_ids' => $uploaded_media->media_id_string
												]);

            if($tweetMedia)
            {
            	return response()->json([
                    'success' => true,
                    'message' => 'Tweet media berhasil di posting!',
                ], 200);
            }
        }

    }
}
