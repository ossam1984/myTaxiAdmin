<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class OrderRequest extends FormRequest
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
            "app_user_id"=>'required',
            "dev_id"=>'required',
            "place_from_name"=>'required',
            "place_to_name"=>'required',
            "place_from_lat"=>'required',
            "place_from_lng"=>'required',
            "place_to_lat"=>'required',
            "place_to_lng"=>'required',
            "distance_m"=>'required',
            "distance_k"=>'required',
            "price_total"=>'required',
            "price_distance_k_first"=>'required',
            "price_first"=>'required',
            "steps"=>'required',
            "price_galon"=>'required',
            "transportation_id"=>'required',
            "order_type_id"=>'required',
            
        ];
    }

    public function response(array $errors){
        return new JsonResponse($errors, 422);
    }
}
