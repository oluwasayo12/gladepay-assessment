<?php

namespace App\Services;

use App\Contracts\CompaniesInterface;
use App\Http\Controllers\AdminController;
use App\Jobs\SendEmailNotificationJob;
use App\Models\Companies;
use App\Models\User;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class CompaniesService implements CompaniesInterface
{
    use ApiResponse;

    /**
     * Returs company and employees record
     *
     * @return void
     */
    public function viewEmployees()
    {
        $currentCompany = Auth::user()->id;
        $companyWithEmployeesData = Companies::with('employees')->where('user_id',$currentCompany)->paginate(10);

        if (is_null($companyWithEmployeesData)) {
            return $this->badRequestAlert('Company employees not found');
        }
        return $this->successResponse('Company employees found successfully', $companyWithEmployeesData);
    }

    /**
     * Create new company record
     *
     * @param array $newCompanyRecord
     * @return void
     */
    public function createCompanyAccount( array $newCompanyRecord )
    {
        DB::beginTransaction();
        try {

            //Create company record in users table
            $companyInitialRecord = User::create(
                [
                    'email'=>$newCompanyRecord['email'],
                    'password'=>$newCompanyRecord['password']
                ]
            ); 

            AdminController::assignRoles(Companies::DEFAULT_ROLE, $companyInitialRecord);

            $createCompany = Companies::create(
                [
                    'user_id'=>$companyInitialRecord->id,
                    'name'=>$newCompanyRecord['name'],
                    'logo'=>$newCompanyRecord['logo_path'],
                    'website'=>$newCompanyRecord['website']
                ]
            );

            DB::commit();
            Activity()->log(Auth::user()->email.' created a new company record. Company name: '.$createCompany->name);
            SendEmailNotificationJob::dispatch($createCompany->name);
            return $this->createdResponse('Company record created');

        }catch(Exception $e)
        {
            DB::rollBack();
            Log::warning($e->getMessage());
            return $this->badRequestAlert('Unable to create company record');
        }
    }

    /**
     * Delete a company record
     *
     * @param integer $companyId
     * @return void
     */
    public function deleteCompanyAccount(int $companyId)
    {
        $companyRecord = User::where('id',$companyId)->first();

        if(empty($companyRecord))
        {
            return $this->badRequestAlert('Invalid company id provided');
        }

        if(!$companyRecord->company()->delete())
        {
            return $this->badRequestAlert('Unable to delete company record');
        }
        //delete company profile
        $companyRecord->delete();

        return $this->successResponse('Company record deleted successfully');

    }

}