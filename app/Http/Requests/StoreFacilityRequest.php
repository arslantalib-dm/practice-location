<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacilityRequest extends FormRequest
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
            "name" => "required|string",
            "sh_name" => "required|string",
            "pdf_type" => "required|in:citimed,optimum", // select one value

            "location.id" => "nullable|integer",
            "location.name" => "nullable|string",
            "location.address" => "nullable|string",
            "location.city" => "nullable|string",
            "location.state" => "nullable|string",
            "location.zip" => "nullable|string",
            "location.floor" => "nullable|string",
            "location.phone" => "nullable|string",
            "location.email" => "nullable|email",
            "location.ext_no" => "nullable|string",
            "location.cell_no" => "nullable|string",
            "location.fax" => "nullable|string",
            "location.is_main" => "nullable|boolean",
            "location.same_as_provider" => "nullable|boolean",

            "location.billing.id" => "nullable|integer",
            "location.billing.provider_name" => "nullable|string",
            "location.billing.address" => "nullable|string",
            "location.billing.city" => "nullable|string",
            "location.billing.state" => "nullable|string",
            "location.billing.zip" => "nullable|string",
            "location.billing.floor" => "nullable|string",
            "location.billing.phone" => "nullable|string",
            "location.billing.email" => "nullable|email",
            "location.billing.ext_no" => "nullable|string",
            "location.billing.cell_no" => "nullable|string",
            "location.billing.fax" => "nullable|string",
            "location.billing.npi" => "nullable|string",
            "location.billing.task_id_check" => "required|integer|in:1,2", // if task_id_check == 1 then tin required else ssn required
            "location.billing.tin" => "required_if:location.billing.task_id_check,1|string|min:9|max:9", // Conditional requirement
            "location.billing.ssn" => "required_if:location.billing.task_id_check,2|string|min:9|max:9", // Conditional requirement
            "location.billing.dean" => "nullable|string",
            "location.billing.dol" => "nullable|string",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Name is required.",
            "sh_name.required" => "Short name is required.",
            "pdf_type.required" => "PDF type is required.",
            "pdf_type.in" => "Invalid PDF type selected.",

            "location.same_as_provider.required" => "Same as provider field is required.",

            "location.billing.task_id_check.required" => "Task ID check is required.",
            "location.billing.task_id_check.in" => "Invalid task ID value.",
            "location.billing.tin.required_if" => "TIN is required when task ID is 1.",
            "location.billing.ssn.required_if" => "SSN is required when task ID is 2.",
        ];
    }
}
