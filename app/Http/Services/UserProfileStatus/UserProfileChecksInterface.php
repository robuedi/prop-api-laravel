<?php

namespace App\Http\Services\UserProfileStatus;

interface UserProfileChecksInterface
{
    public function checkEmployment(int $user_id) : bool;

    public function checkAnnualSalary(int $user_id) : bool;

    public function checkRent(int $user_id) : bool;

    public function checkAddress(int $user_id) : bool;
    public function checkSavings(int $user_id) : bool;
}
