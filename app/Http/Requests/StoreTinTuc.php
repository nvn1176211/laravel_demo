<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTinTuc extends FormRequest
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
            'TieuDe' => 'required|min:3|max:100|unique:tintuc,TieuDe',
            'NoiDung' => 'required',
            'Hinh' => 'image'
        ];
    }

    public function messages(){
        return [
            'TieuDe.required' => 'Tên tiêu đề không được để trống',
            'NoiDung.required' => 'Nội dung không được để trống',
            'TieuDe.min' => 'Tên tiêu đề phải chứa nhiều hơn 3 kí tự',
            'TieuDe.max' => 'Tên tiêu đề phải chứa dưới 100 kí tự',
            'TieuDe.unique' => 'Tên tiêu đề này đã tồn tại',
            'Hinh.image' => 'file tải lên phải là file hình ảnh' 
        ];
    }
}
