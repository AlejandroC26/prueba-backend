<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreCandidateRequest extends FormRequest
{
    use ApiResponse;
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
            'name' => 'required',
            'source' => 'required',
            'owner' => [
                'required',
                Rule::exists(User::class, 'id')
            ],
        ];
    }

    public function messages()
	{
		return [
			'name.required' => 'El parametro :attribute es requerido',
			'source.required' => 'El parametro :attribute es requerido',
			'owner.required' => 'El parametro :attribute es requerido',
			'owner.exists' => 'El :attribute no fue encontrado'
		];
	}

    public function failedValidation(Validator $validator)
	{

		throw new HttpResponseException($this->errorResponse($validator->errors()));
	}
}
