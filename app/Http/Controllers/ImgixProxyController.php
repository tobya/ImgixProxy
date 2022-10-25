<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;



class ImgixProxyController extends Controller
{
    //

    public  function proxy(){
//https://bcsstudentimages.imgix.net/nobody.jpg?h=106&w=106&fit=facearea&facepad=2.3
    //https://bcsstudentimages.imgix.net/6026717.jpg?h=106&w=106&fit=facearea&facepad=2.3
       $url = \Spatie\Url\Url::fromString(url()->full());
       $url2 = $url->withHost('bcsstudentimages.imgix.net')->withScheme('https')->withPort(null);
       $id = Hash::make($url2);
       $publicdir = Storage::build(public_path());
       $publicdir->makeDirectory('/files/');
       Http::sink($publicdir->path('/files/'. $id . '.jpg'))->get($url2);
       print_r (request()->input());

       return view('proxy.show',[
          'link' => $url2,
           'fn' => $publicdir->path('/files/') . $id . '.jpg',
            'imgsrc' => url()->route('filename',['filename' => '/files/'. $id . '.jpg' ])
       ]);
    }

    /**
     * save image on the way and return
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public  function image(){

       $url = \Spatie\Url\Url::fromString(url()->full());
       $url2 = $url->withHost('bcsstudentimages.imgix.net')
                    ->withScheme('https')
                    ->withPort(null);

       $id = md5($url2);
       $publicdir = Storage::build(public_path());
       $fn = '/files/'. $id . '.jpg';
       if ($publicdir->exists($fn)){
           return response()->file($publicdir->path($fn),['cache-control' => 'max-age=86400']);
       }

       Http::sink($publicdir->path($fn))->get($url2);
       return response()->file($publicdir->path($fn),['cache-control' => 'max-age=86400']);

    }
}
