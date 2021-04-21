<?php


namespace App\Repositories\Repositories;


use App\Models\Property;
use App\Repositories\PropertyRepositoryInterface;
use App\Http\Services\MediaFile\MediaFileService;
use Illuminate\Support\Facades\Log;

class PropertyRepository implements PropertyRepositoryInterface
{
    private Property $property;
    private MediaFileService $mediaFileService;

    public function __construct(Property $property, MediaFileService $mediaFileService)
    {
        $this->property = $property;
        $this->mediaFileService = $mediaFileService;
    }

    public function createRelational(array $property_data)
    {
        //make the property
        $property = $this->property::create($property_data);

        //make address
        if(!isset($property_data['address']))
        {
            $property->address()->create($property_data['address']);
        }

        //add media
        if(isset($property_data['media_file']))
        {
            //TODO finish this
            $info = $this->mediaFileService->getFileInfo($property_data['media_file'], 'properties', 'public');
            Log::info($info->getName());
            Log::info($info->getPath());
            Log::info($info->getType());
        }

        return $property;
    }
}
