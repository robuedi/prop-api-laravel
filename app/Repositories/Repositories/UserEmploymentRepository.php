<?php


namespace App\Repositories\Repositories;

use App\Models\Employment;
use App\Repositories\UserEmploymentRepositoryInterface;

class UserEmploymentRepository implements UserEmploymentRepositoryInterface
{
    private Employment $user_employment;

    public function __construct(Employment $user_employment)
    {
        $this->user_employment = $user_employment;
    }

    public function create(int $user_id, string $job_title, string $start_date, string $end_date ) : Employment
    {
        return $this->user_employment
            ->create([
                'user_id' => $user_id,
                'job_title' => $job_title,
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
    }

    public function getFirstByUserId(int $user_id) : ?Employment
    {
        return $this->user_employment
            ->where(['user_id' => $user_id])
            ->first();
    }
}
