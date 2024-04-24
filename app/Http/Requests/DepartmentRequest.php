<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Chú ý: Bạn cần kiểm tra quyền truy cập ở đây nếu cần
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|string|max:255', // Mã phòng ban là bắt buộc, kiểu chuỗi, tối đa 255 ký tự
            'name' => 'required|string|max:255', // Tên phòng ban là bắt buộc, kiểu chuỗi, tối đa 255 ký tự
            'parent_id' => 'nullable|exists:departments,id', // Nếu có, parent_id phải tồn tại trong bảng departments
            'company_id' => 'required|exists:companies,id', // company_id là bắt buộc và phải tồn tại trong bảng companies
        ];
    }
}
