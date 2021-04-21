<?php


namespace App\Http\Services\MediaFile;

use Illuminate\Http\UploadedFile;

class MediaFileService implements MediaFileServiceInterface
{
    public MediaFileItemInterface $media_file_item;

    public function __construct(MediaFileItemInterface $media_file_item)
    {
        $this->media_file_item = $media_file_item;
    }

    public function getFileInfo(UploadedFile $file, string $path, string $disk) : MediaFileItemInterface
    {
        //get name
        $file_name = time().'-'.substr($file->getClientOriginalName(),-80);

        //store and get path
        $newPath = $file->storeAs('uploads/media-files/'.$path.'/'.date('Y').'/'.date("m"), $file_name, ['disk' => $disk]);

        //get file info
        $this->media_file_item->setPath($newPath);
        $this->media_file_item->setName($file_name);
        $this->media_file_item->setType(strtolower($file->getClientMimeType()));

        return $this->media_file_item;
    }

}
