<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RoleUserAnnualSalaryIndexRequest;
use App\Http\Requests\v1\RoleUserAnnualSalaryStoreRequest;
use App\Http\Resources\v1\AnnualSalaryResource;
use App\Models\RoleUser;
use Illuminate\Http\Response;

class AnnualSalariesController extends Controller
{
    public function storeForUser(RoleUser $role_user, RoleUserAnnualSalaryStoreRequest $request)
    {
        //make property for user
        return AnnualSalaryResource::make(
            $role_user->annualSalary()->create(['amount' => $request->get('amount')])
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function indexForUser(RoleUser $role_user, RoleUserAnnualSalaryIndexRequest $request)
    {
        //make property for user
        return AnnualSalaryResource::collection(
            $role_user->annualSalary
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

}
