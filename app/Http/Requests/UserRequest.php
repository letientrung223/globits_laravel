<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        // Lấy thông tin người dùng hiện tại từ route

        return [
            'email' => 'required|email',
            'is_active' => 'boolean',
            'password'=>'required|min:6',
        ];
    }

}
