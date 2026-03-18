<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    public function upload(UploadedFile $file, string $directory, string $name = '')
    {
        $newFilename = ($name ? $name . '-' : '') . uniqid() . '.' . $file->guessExtension();
        $file->move($directory, $newFilename);
        return $newFilename;
    }
}
