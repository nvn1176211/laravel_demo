<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'xnpassword' => 'same:password'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên không được để trống',
            'xnpassword.same'=> 'Password xác nhận không khớp',
            'name.min' => 'Tên phải chứa nhiều hơn 3 kí tự',
            'name.max' => 'Tên phải chứa dưới 100 kí tự',

        ];
    }
}
