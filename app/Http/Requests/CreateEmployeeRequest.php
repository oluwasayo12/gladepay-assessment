<?php

namespace App\Http\Requests;

use App\Models\Employees;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id'=>'required|string|exists:companies,id',
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|unique:'.User::class.',email',
            'password'=>'required|string|confirmed', 
            'phone'=>'required|string|digits:13', 
        ];
    }


}
