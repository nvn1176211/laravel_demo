<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlide extends FormRequest
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
            'Ten' => 'required|min:3|max:100|unique:slide,Ten',
            'NoiDung' => 'required',
            'Hinh' => 'required|image',
            'link'=> 'required'
        ];
    }

    public function messages(){
        return [
            'Ten.required' => 'Tên không được để trống',
            'Hinh.required' => 'Hình không được để trống',
            'link.required' => 'Link không được để trống',
            'NoiDung.required' => 'Nội dung không được để trống',
            'Ten.min' => 'Tên phải chứa nhiều hơn 3 kí tự',
            'Ten.max' => 'Tên phải chứa dưới 100 kí tự',
            'Ten.unique' => 'Tên này đã tồn tại',
            'Hinh.image' => 'file tải lên phải là file hình ảnh' 
        ];
    }
}
