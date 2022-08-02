<?php

namespace App\Http\Controllers;

use App\Contracts\EmployeesInterface;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller
{

    public function __construct(EmployeesInterface $employees)
    {
        $this->employees = $employees;
    }

    /**
     * show
     * Return employee data with company details
     * @return void
     */
    public function show()
    {
        return  $this->employees->viewCompanyDetails();
    }

    /**
     * create
     * Create a new Employee Record
     * @param CreateEmployeeRequest $employeeRecord
     * @return void
     */
    public function create(CreateEmployeeRequest $employeeRecord )
    {
        return $this->employees->createCompanyEmployeeAccount($employeeRecord->all());
    }

    /**
     * delete
     * Delete a employee record
     * @param integer $employeeID
     * @return void
     */
    public function delete(int $employeeID)
    {
        return $this->employees->deleteEmployeeAccount($employeeID);
    }

}
