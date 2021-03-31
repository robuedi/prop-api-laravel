<?php


namespace App\Repositories\Repositories;


use App\Models\Property;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\Repositories\Params\PropertyRepositoryIndexParamInterface;
use Illuminate\Support\Facades\Log;

class PropertyRepository implements PropertyRepositoryInterface
{
    private Property $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function index(PropertyRepositoryIndexParamInterface $index_param)
    {

        $query = $this->property::query();

        //check if messages required
        if($index_param->getAddress())
        {
            $query->with(['address' => function($query) use ($index_param){
                $query->select($index_param->getAddress());
            }]);
        }

        //check if with city
        if($index_param->getCity())
        {
            $query->with(['address.city' => function($query) use ($index_param){
                $query->select($index_param->getCity());
            }]);
        }

        //check if with country
        if($index_param->getCountry())
        {
            $query->with(['address.city.country' => function($query) use ($index_param){
                $query->select($index_param->getCountry());
            }]);
        }

        if($index_param->getUserId())
        {
            $query->wherehas('userProperty', function($query) use ($index_param){
                $query->where('user_id', $index_param->getUserId());
            })
            ->with(['userProperty']);
        }

        if($index_param->getFields())
        {
            $query->select($index_param->getFields());
        }

        return $query->get();
    }



    public function create(array $data)
    {
        //make the property
        return $this->property::create($data);
    }
}
