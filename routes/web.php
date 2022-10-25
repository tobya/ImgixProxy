<?php

use Illuminate\Support\Facades\Route;

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


Route::any('/{any}', function ($any) {

    // Store how many times  a route has been called.
    if(\Illuminate\Support\Facades\Cache::has('route_' .$any)){
        \Illuminate\Support\Facades\Cache::increment('route_' . $any);
    } else {
        \Illuminate\Support\Facades\Cache::put('route_' . $any,1);
    }

    if (file_exists(public_path($any))){
        require public_path($any);
        return;
    }

       $ext = pathinfo($any, PATHINFO_EXTENSION);

       if ($ext == ''){
         $any .= '/index.php';
       }

    //return    (new \App\Http\Controllers\ImgixProxyController())->proxy();
    return    (new \App\Http\Controllers\ImgixProxyController())->image();

})->where('any', '.*');

Route::get('/{filename}',[])->name('filename');

