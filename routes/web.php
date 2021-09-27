<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwitterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/tweet', function()
// {
// 	return Twitter::postTweet(['status' => 'Tes from postman', 'response_format' => 'json']);
// });

// Route::get('/tweetMedia', function()
// {
// 	$uploaded_media = Twitter::uploadMedia(['media' => File::get(public_path('images\164.jpg'))]);
// 	return Twitter::postTweet(['status' => 'Laravel is beautiful', 'media_ids' => $uploaded_media->media_id_string]);
// });
Route::post('/tweet/store', [TwitterController::class, 'store']);
Route::post('/tweet/storemedia', [TwitterController::class, 'storemedia']);