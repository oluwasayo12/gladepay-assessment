<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Contracts\CompaniesInterface;
use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{

    protected $companies;

    public function __construct(CompaniesInterface $companies)
    {
        $this->companies = $companies;
    }
    
    /**
     * Return company record with all employees data
     *
     * @return void
     */
    public function show()
    {
        return $this->companies->viewEmployees();
    }

    /**
     * create a new company record
     *
     * @param CreateCompanyRequest $companyRecordRequest
     * @return void
     */
    public function create(CreateCompanyRequest $companyRecordRequest)
    {

        if(!$companyRecordRequest->hasFile('logo')) {
            return $this->badRequestAlert('Company logo not provided');
        }
     
        $allowedfileExtension= Companies::DEFAULT_FILE_FORMAT;
        $logo = $companyRecordRequest->file('logo'); 

        $extension = $logo->getClientOriginalExtension();
 
        $imageCheck = in_array($extension,$allowedfileExtension);

        if(!$imageCheck)
        {
            return $this->badRequestAlert('Invalid file format');   
        }

        Storage::put('public/company_logo', $logo);
        $companyRecordRequest['logo_path'] = getenv('APP_URL').'/storage/company_logo/'.$logo->hashName();
        return $this->companies->createCompanyAccount($companyRecordRequest->all());
    }

    /**
     * Delete a company record
     *
     * @param integer $companyId
     * @return void
     */
    public function delete(int $companyId)
    {
        return $this->companies->deleteCompanyAccount($companyId);
    }

}
