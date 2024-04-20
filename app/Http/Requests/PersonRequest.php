<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required|date',
            'phone_number' => 'required|string|max:20',
            'address' => 'nullable|string',
        ];
    }
}
