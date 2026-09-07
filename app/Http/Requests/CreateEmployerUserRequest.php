<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployerUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'title'                     => 'required|string',
            'description'               => 'required|string',
            'company_background_info'   => 'required|string',
            'skillset_About'            => 'required|string',
            'benefits'                  => 'required|string',
            'location'                  => 'required|string',
            'category_id'               => 'required|exists:categories,id',
            'city'                      => 'required|string',
            'address'                   => 'required|string',
            'post_code'                 => 'required|string',
            'job_type'                  => 'required|string',
            'status'                    => 'required|string',
            'expires_at'                => 'required|date'
        ];
    }
}
