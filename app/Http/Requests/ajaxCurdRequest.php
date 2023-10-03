<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ajaxCurdRequest extends FormRequest
{
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ],200)
        );
    }
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'=>['required'],
            'email'=>['required','email'],
            'phone'=>['required'],
            'reg'=>['required'],
            'roll'=>['required'],
            'board'=>['required'],
            'session'=>['required'],
            'avater'=>['required']
        ];

        if(request()->update != ''){
            $rules['avater'][0] = 'nullable';
        }
        return $rules;
    }
}
