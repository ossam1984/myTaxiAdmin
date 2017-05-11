<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UserRegisterRequest extends FormRequest
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
    public function rules(Request $request)
    {
        // $validation = [];
        $validation = [
            "first_name" => ["required","min:1"],
            "last_name" => ["required","min:1"],
            "gender" => ["required"],
            "email" => ["email","min:5"],
            "phone" => ["required"],
            "dev_id" => ["required"],
            "password" => ["required"],
            // "password" => ["dev_id"],
            "owner_type" => ["required"]


        ];
        if($request->get("owner_type")==\App\Driver::class){
            // $validation = [];
        }
        elseif($request->get("owner_type")==\App\Customer::class){

        }
        
        // $validation = [];

        return $validation;
    }

    public function response(array $errors){
        return new JsonResponse($errors, 422);
    }
}
