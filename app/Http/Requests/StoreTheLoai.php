<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTheLoai extends FormRequest
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
            'Ten' => 'required|min:3|max:100|unique:theloai,Ten'
        ];
    }

    public function messages(){
        return [
            'Ten.required' => 'Tên không được để trống',
            'Ten.min' => 'Tên phải chứa nhiều hơn 3 kí tự',
            'Ten.max' => 'Tên phải chứa dưới 100 kí tự',
            'Ten.unique' => 'Tên này đã tồn tại',
        ];
    }
}
