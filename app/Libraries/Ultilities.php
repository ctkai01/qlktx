<?php

namespace App\Libraries;
use File;
use Intervention\Image\Facades\Image;
class Ultilities
{

    public static function clearXSS($string)
    {
        $string = nl2br($string);
        $string = trim(strip_tags($string));
        $string = self::removeScripts($string);

        return $string;
    }

    public static function clearArray($arrays)
    {   
        $stringArray = [];
        foreach($arrays as $key => $value) {
            $string = nl2br($value);
            $string = trim(strip_tags($string));
            $string = self::removeScripts($string);
            $stringArray[$key] = $string;
        }
        return $stringArray;
    }

    public static function removeScripts($str)
    {
        $regex =
            '/(<link[^>]+rel="[^"]*stylesheet"[^>]*>)|'.
            '<script[^>]*>.*?<\/script>|'.
            '<style[^>]*>.*?<\/style>|'.
            '<!--.*?-->/is';

        return preg_replace($regex, '', $str);
    }

    public static function uploadFile($file , $path = null)
    {
        $publicPath = public_path('uploads');
        if(!empty($path)){
            $publicPath = public_path($path);
        }
        if (!File::exists($publicPath)) {
            File::makeDirectory($publicPath, 0775, true, true);
        }
        $name = time().$file->getClientOriginalName();
        $name = preg_replace('/\s+/', '', $name);
        $file->move($publicPath, $name);

        if(!empty($path)){
            return $path.'/'.$name;
        }
        return  '/uploads/' .$name;
    }

    //full url image, avatar...
    public static function replaceUrlImage($val, $type = 0)
    {
        $image = '';
        if (!empty($val)) {
            if (!filter_var($val, FILTER_VALIDATE_URL)) {
                $image = url($val);
            } else {
                $image = $val;
            }
        }
        return $image;
    }

    // public static function resizeImageAndUpload($file, $w, $h, $path = null) {
        
        
    //     $input['imagename'] = time().$file->getClientOriginalName();
    //     $input['imagename'] = preg_replace('/\s+/', '', $input['imagename']);
    //     $publicPath = public_path('uploads');
    //     if(!empty($path)){
    //         $publicPath = public_path($path);
    //     }
    //     if (!File::exists($publicPath)) {
    //         File::makeDirectory($publicPath, 0775, true, true);
    //     }

    //     $img = Image::make($file->path());
    //     $img->resize($w, $h, function ($const) {
    //         $const->aspectRatio();
    //         $const->upsize();
    //     })->save($publicPath.'/'.$input['imagename']);

    //     if(!empty($path)){
    //         return $path.'/'.$input['imagename'];
    //     }
    //     return  '/uploads/' .$input['imagename'];
    // }

}