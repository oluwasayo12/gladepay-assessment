<?php
namespace App\Contracts;

interface EmployeesInterface {

    public function viewCompanyDetails();
    public function createCompanyEmployeeAccount(array $newEmployeeRecord);
    public function deleteEmployeeAccount(int $employeeID);

}