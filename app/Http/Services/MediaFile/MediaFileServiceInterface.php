<?php

namespace App\Http\Services\MediaFile;

use Illuminate\Http\UploadedFile;

interface MediaFileServiceInterface
{
    public function getFileInfo(UploadedFile $file, string $path, string $disk): MediaFileItemInterface;
}
