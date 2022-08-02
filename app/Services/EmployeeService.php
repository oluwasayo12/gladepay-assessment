<?php

namespace App\Services;

use App\Contracts\EmployeesInterface;
use App\Http\Controllers\AdminController;
use App\Models\Employees;
use App\Models\User;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeService implements EmployeesInterface
{
    use ApiResponse;

    /**
     * Return current loggedin employee record with company details
     *
     * @return void
     */
    public function viewCompanyDetails()
    {
        $currentEmployee = Auth::user()->id;
        $employeesWithCompanyData = Employees::with('company')->where('user_id',$currentEmployee)->first();
        

        if (is_null($employeesWithCompanyData)) {
            return $this->badRequestAlert('Employee not found');
        }
        return $this->successResponse('Employee found successfully', $employeesWithCompanyData);
    }


    /**
     * Create new employe record
     *
     * @param array $newEmployeeRecord
     * @return void
     */
    public function createCompanyEmployeeAccount( array $newEmployeeRecord )
    {
        DB::beginTransaction();
        try {

            //Create employee record in users table
            $employeeInitialRecord = User::create(
                [
                    'email'=>$newEmployeeRecord['email'],
                    'password'=>$newEmployeeRecord['password']
                ]
            ); 

            AdminController::assignRoles(Employees::DEFAULT_ROLE, $employeeInitialRecord);

            $createEmployeeRecord = Employees::create(
                [
                    'user_id'=>$employeeInitialRecord->id,
                    'company_id'=>$newEmployeeRecord['company_id'],
                    'first_name'=>$newEmployeeRecord['first_name'],
                    'last_name'=>$newEmployeeRecord['last_name'],
                    'phone'=>$newEmployeeRecord['phone'],
                ]
            );


            DB::commit();
            return $this->createdResponse('Employee record created');

        }catch(Exception $e)
        {
            DB::rollBack();
            Log::warning($e->getMessage());
            return $this->badRequestAlert('Unable to create company employee record');
        }
    }

    /**
     * Delete employee record
     *
     * @param integer $employeeID
     * @return void
     */
    public function deleteEmployeeAccount(int $employeeID)
    {
        $employeeRecord = User::where('id',$employeeID)->first();

        if(empty($employeeRecord))
        {
            return $this->badRequestAlert('Invalid employee id provided');
        }

        if(!$employeeRecord->employee()->delete())
        {
            return $this->badRequestAlert('Unable to delete employee record');
        }

        //delete employee profile
        $employeeRecord->delete();

        return $this->successResponse('Employee record deleted successfully');
    }

}