<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
            "signature_file" => "required|image|mimes:jpg,jpeg,png|max:2048",
            "object_id" => "required|integer",
            "doc_type" => "required|string",
            "file_title" => "required|string",
        ];
    }
}
