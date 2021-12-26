<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
//            'first_name' => 'required',
//            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
//            'phone' => 'required|unique:users,phone,' . $this->id,
//            'address' => 'required',
//            'postcode' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
        ];
    }

    public function attributes()
    {
        return [
//            'first_name' => 'First Name',
//            'last_name' => 'Last Name',
            'email' => 'Email',
//            'address' => 'Address',
//            'postcode' => 'Post Code',
//            'phone' => 'Phone',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }

}
