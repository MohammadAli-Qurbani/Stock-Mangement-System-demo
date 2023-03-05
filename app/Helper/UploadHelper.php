<?php

namespace App\Helper;

use Exception;
use Illuminate\Support\Str;

class UploadHelper
{
    public function __construct(public $file, public string $dir)
    {
    }

    public function imageUploadHelper(): string {
        try {
            $extension = $this->file->getClientOriginalExtension();
            $fileName = Str::random() . '.' . $extension;
            $path = $this->file->move($this->dir, $fileName);
            return $path;
            //code...
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
