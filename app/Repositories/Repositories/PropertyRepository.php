<?php


namespace App\Repositories\Repositories;

use App\Http\Services\MediaFile\MediaFileServiceInterface;
use App\Models\Property;
use App\Repositories\PropertyRepositoryInterface;

class PropertyRepository implements PropertyRepositoryInterface
{
    private Property $property;
    private MediaFileServiceInterface $mediaFileService;

    public function __construct(Property $property, MediaFileServiceInterface $mediaFileService)
    {
        $this->property = $property;
        $this->mediaFileService = $mediaFileService;
    }

    public function createRelational(array $property_data)
    {
        //make the property
        $property = $this->property::create($property_data);

        //make address
        if(isset($property_data['address']))
        {
            $property->address()->create($property_data['address']);
        }

        //add media
        if(isset($property_data['media_file']))
        {
            $info = $this->mediaFileService->getFileInfo($property_data['media_file'], 'properties', 'public');
            $property->images()->create([
                'name' => $info->getName(),
                'path' => $info->getPath(),
                'type' => $info->getType()
            ]);
        }

        return $property;
    }
}
