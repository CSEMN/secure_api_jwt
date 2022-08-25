<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreFile
{
    public static function store($file, $folder = 'media')
    {
        $file_name = $folder . '/' . Str::random(40) . '.' . $file->extension();
        Storage::putFileAs('/public/', $file, $file_name);
        return $file_name;
    }
}
