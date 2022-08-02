<?php
namespace App\Contracts;

interface CompaniesInterface {

    public function viewEmployees();
    public function createCompanyAccount(array $newCompanyRecord);
    public function deleteCompanyAccount(int $companyId);

}