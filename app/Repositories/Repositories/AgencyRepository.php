<?php


namespace App\Repositories\Repositories;

use App\Models\Agency;
use App\Repositories\AgencyRepositoryInterface;

class AgencyRepository implements AgencyRepositoryInterface
{
    private Agency $agency;

    public function __construct(Agency $agency)
    {
        $this->agency = $agency;
    }

    public function create(int $user_id, string $name, int $is_public) : Agency
    {
        return $this->agency
            ->create([
                'user_id' => $user_id,
                'name' => $name,
                'is_public' => $is_public
            ]);
    }

    public function getFirstByUserId(int $user_id) : ?Agency
    {
        return $this->agency
            ->where(['user_id' => $user_id])
            ->first();
    }
}
