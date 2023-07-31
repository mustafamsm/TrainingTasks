<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname'=>'required|string|max:50',  
            'lastname'=>'required|string|max:50',
            'username'=>'required|string|max:50|unique:admins,username',
            'email'=>'required|email|max:50|unique:admins,email',
            'password'=>'required|string|min:8|max:255|confirmed',
            'password_confirmation'=>'required|string|min:8|max:255',
            'phone'=>'nullable|string|max:20',
            'address'=>'nullable|string|max:255',
            'photo'=>'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
          
            
        ];
    }
}
