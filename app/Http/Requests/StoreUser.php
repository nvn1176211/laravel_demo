<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:3|max:100',
            'xnpassword' => 'required|min:3|max:100|same:password'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'password.required' => 'Password không được để trống',
            'xnpassword.required' => 'Xác nhận password không được để trống',
            'xnpassword.same'=> 'Password xác nhận không khớp',
            'name.min' => 'Tên phải chứa nhiều hơn 3 kí tự',
            'name.max' => 'Tên phải chứa dưới 100 kí tự',

        ];
    }
}
