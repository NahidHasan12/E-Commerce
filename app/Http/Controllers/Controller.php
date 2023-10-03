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

    protected function file_remove($folder, $old_file){
        return file_exists($folder.$old_file) ? unlink($folder.$old_file) : false;
    }
}
