<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacilityLocationRequest extends FormRequest
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
            "id" => "nullable|integer|exists:facility_locations,id",
            "facility_id" => "required|integer",
            "name" => "required|string",
            "qualifier" => "required|string",
            "address" => "nullable|string",
            "city" => "nullable|string",
            "state" => "nullable|string",
            "zip" => "nullable|string",
            "floor" => "nullable|string",
            "phone" => "nullable|string",
            "email" => "nullable|email",
            "ext_no" => "nullable|string",
            "cell_no" => "nullable|string",
            "fax" => "nullable|string",
            "is_main" => "nullable|boolean",
            "dean" => "nullable|string",
            "region_id" => "required|integer",
            "lat" => "nullable|numeric",
            "long" => "nullable|numeric",
            "place_of_service_id" => "required|integer",
            "timings" => "required|array",
            "timings.*.checked" => "required|boolean",
            "timings.*.day_id" => "required|integer",
            "timings.*.start_time" => "required|string",
            "timings.*.end_time" => "required|string",
            "time_zone" => "required|array",
            "time_zone.time_zone" => "required|numeric",
            "time_zone.time_zone_string" => "required|string",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Name is required.",
            "qualifier.required" => "Short name is required.",
        ];
    }
}
