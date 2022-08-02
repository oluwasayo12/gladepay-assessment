<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\UtilityTrait;
use Illuminate\Support\Facades\Hash;

class CreateAdminRequest extends FormRequest
{
    use UtilityTrait;

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
            'email' => 'required|unique:'.User::class.',email|ends_with:admin.com',
            'password' => 'required|string|confirmed'
        ];
    }
    
    /**
     * prepareForValidation
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'phone_no' => $this->formatPhoneNumber($this->phone_no),
        ]);
    }


    public function withValidator($validator)
    {
        $this->merge(['password' => Hash::make($this->password) ]);
    }
}
