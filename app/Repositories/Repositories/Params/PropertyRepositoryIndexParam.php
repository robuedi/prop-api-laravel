<?php


namespace App\Repositories\Repositories\Params;

class PropertyRepositoryIndexParam implements PropertyRepositoryIndexParamInterface
{
    private ?string $address = null;
    private ?string $city = null;
    private ?string $country = null;
    private array $fields = [];
    private ?int $user_id = null;
    private bool $user_type = false;
    private ?bool $active = null;

    /**
     * @return bool
     */
    public function getUserType(): bool
    {
        return $this->user_type;
    }

    /**
     * @param bool $user_type
     */
    public function setUserType(bool $user_type): PropertyRepositoryIndexParamInterface
    {
        $this->user_type = $user_type;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param bool $active
     */
    public function setActive(?bool $active): PropertyRepositoryIndexParamInterface
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     */
    public function setUserId(?int $user_id): PropertyRepositoryIndexParamInterface
    {
        $this->user_id = $user_id;
        return $this;
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
