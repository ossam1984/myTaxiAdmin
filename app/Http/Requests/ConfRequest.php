<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ConfRequest extends FormRequest
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
            'phone'=>'required',
            'dev_id'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'user_type'=>'required',
            // 'user_type'=>'required',
        ];

    }
    public function response(array $errors){
        return new JsonResponse($errors, 422);
    }
}
