<?php

namespace App\Http\Services\RoleUserStatus;

use App\Models\Employment;

interface RoleUserChecksInterface
{
    public function checkEmployment(int $user_id);
    public function checkAnnualSalary(int $user_id);
    public function checkRent(int $user_id);
    public function checkAddress(int $user_id);
    public function checkSavings(int $user_id);
    public function checkAgency(int $user_id);
    public function checkAgencyAddress(int $agency_id) ;
}
