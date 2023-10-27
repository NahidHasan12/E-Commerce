<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use function PHPUnit\Framework\fileExists;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function file_upload($file, $folder){
        $img_file = $file;
        $file_extension = $img_file->getClientOriginalExtension();
        $img_name = time().rand().'.'.$file_extension;
        $img_file->move($folder,$img_name);
        return $img_name;
    }

    protected function file_update($file, $folder, $old_file){
        if($old_file != NULL){
            file_exists($folder.$old_file) ? unlink($folder.$old_file) : false;
        }
        $img_file = $file;
        $file_extension = $img_file->getClientOriginalExtension();
        $img_name = time().rand().'.'.$file_extension;
        $img_file->move($folder,$img_name);
        return $img_name;
    }

    protected function multiple_file_upload($files, $folder){
        foreach ($files as $key => $image) {
            $file_extension = $image->getClientOriginalExtension();
            $img_name = time().rand().'.'.$file_extension;
            $image->move($folder,$img_name);
            $new_file_names[] = $img_name;
        }
        return $new_file_names;

    }
    protected function multiple_file_update($files, $folder, $old_file){
        if($old_file != NULL){
            file_exists($folder.$old_file) ? unlink($folder.$old_file) : false;
        }

        foreach ($files as $key => $image) {
            $file_extension = $image->getClientOriginalExtension();
            $img_name = time().rand().'.'.$file_extension;
            $image->move($folder,$img_name);
            $new_file_names[] = $img_name;
        }
        return $new_file_names;

    }

    protected function file_remove($folder, $old_file){
        return file_exists($folder.$old_file) ? unlink($folder.$old_file) : false;
    }
}
