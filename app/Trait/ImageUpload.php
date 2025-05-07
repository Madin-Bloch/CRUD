<?php

namespace App\Trait;

trait ImageUpload
{
    public function upload($file, $subfolder){

         // Base folder under /public/uploads

        $baseFolder = 'uploads/' . $subfolder;

        $destinationPath = public_path($baseFolder);

        if(!file_exists($destinationPath)){
            mkdir($destinationPath,0755,true);
        }

        $filename = uniqid() .'_' . time() .'.'.$file->getClientOriginalExtension();

        $file->move($destinationPath,$filename);
        return $subfolder . '/' .$filename;
    }

    public function getImageUrl ($imagePath){ 
        return asset('uploads/'.$imagePath);
    }
}
