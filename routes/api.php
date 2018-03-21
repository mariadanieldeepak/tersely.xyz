<?php

use App\Url;
use Illuminate\Http\Request;
use App\Repositories\UrlRepository;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'auth:api'], function(){

    Route::post('test', function() {
        return response(['success' => true]);
    });

    Route::post('/shorten/', function(UrlRepository $urlRepository) {
        $shortUrl = $urlRepository->getShortUrl(request('url'));
        return response([
            'success' => true,
            'url' => request()->root() . '/' . $shortUrl
        ]);
    });

    Route::post('/verbose/', function(UrlRepository $urlRepository) {
        $response = ['success' => false, 'url' => ''];

        $short = array_slice(explode('/', request('url')), -1, 1);
        $longUrl = $urlRepository->getLongUrlByShortUrl($short[0]);
        if($longUrl) {
            $response = ['success' => true, 'url' => $longUrl];
        }

        return response($response);
    });

});
