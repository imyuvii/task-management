<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskFiltersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'string|in:New,Incomplete,Complete',
            'due_date' => 'date_format:Y-m-d',
            'priority' => 'string|in:High,Medium,Low',
            'notes' => 'boolean',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function attributes()
    {
        return [
            'status' => 'status filter(New, Incomplete, Complete)',
            'due_date' => 'due date filter(Y-m-d)',
            'priority' => 'priority filter(High, Medium, Low)',
            'notes' => 'notes filter',
        ];
    }
}
