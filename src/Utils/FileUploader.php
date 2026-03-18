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

    public function delete(string $filename, string $directory)
    {
        return unlink($directory . DIRECTORY_SEPARATOR . $filename);
    }

    public function update(string $oldFileName, string $directory, UploadedFile $file, string $newName)
    {
        $this->delete($oldFileName, $directory);
        $this->upload($file, $directory, $newName);
    }
}
