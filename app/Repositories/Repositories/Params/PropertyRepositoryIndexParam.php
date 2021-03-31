<?php


namespace App\Repositories\Repositories\Params;


use Illuminate\Support\Facades\Log;

class PropertyRepositoryIndexParam implements PropertyRepositoryIndexParamInterface
{
    private ?string $address = null;
    private ?string $city = null;
    private ?string $country = null;
    private array $fields = [];
    private ?int $user_id = null;

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     */
    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getFields(): array
    {
        return $this->address ? array_merge(['id'], $this->fields) : $this->fields;
    }

    /**
     * @param string $fields
     */
    public function setFields(?string $fields): PropertyRepositoryIndexParamInterface
    {
        $this->fields = $fields ? explode(',', $fields) : [];
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?array
    {
        if(!$this->address)
        {
            return null;
        }

        Log::info($this->city);
        $extra_fields = $this->city ? ['property_id', 'city_id'] : ['property_id'];
        return array_merge(explode(',', $this->address), $extra_fields);
    }

    /**
     * @param string $address
     */
    public function setAddress(?string $address): PropertyRepositoryIndexParamInterface
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?array
    {
        if(!$this->address||!$this->city)
        {
            return null;
        }

        $extra_fields = $this->country ? [ 'country_id'] : [];
        return array_merge(explode(',', $this->city), $extra_fields);
    }

    /**
     * @param string $address
     */
    public function setCity(?string $city): PropertyRepositoryIndexParamInterface
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): ?array
    {
        if(!$this->city||!$this->country)
        {
            return null;
        }

        return array_merge(explode(',', $this->country), ['id']);
    }

    /**
     * @param string $address
     */
    public function setCountry(?string $country): PropertyRepositoryIndexParamInterface
    {
        $this->country = $country;
        return $this;
    }
}
