<?php

namespace App\Repositories\Repositories\Params;

interface PropertyRepositoryIndexParamInterface
{
    /**
     * @return string
     */
    public function getFields(): array;

    /**
     * @param string $fields
     */
    public function setFields(?string $fields): PropertyRepositoryIndexParamInterface;

    /**
     * @return string
     */
    public function getAddress(): ?array;

    /**
     * @param string $address
     */
    public function setAddress(?string $address): PropertyRepositoryIndexParamInterface;

    /**
     * @return int|null
     */
    public function getUserId(): ?int;

    /**
     * @param int|null $user_id
     */
    public function setUserId(?int $user_id): void;

    /**
     * @return string
     */
    public function getCity(): ?array;

    /**
     * @param string $address
     */
    public function setCity(?string $city): PropertyRepositoryIndexParamInterface;

    /**
     * @return string
     */
    public function getCountry(): ?array;

    /**
     * @param string $address
     */
    public function setCountry(?string $country): PropertyRepositoryIndexParamInterface;
}
