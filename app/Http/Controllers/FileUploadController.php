<?php

namespace App\Http\Controllers;

use App\Enums\ResponseStatus;
use App\Http\Requests\UploadFileRequest;
use App\Service\FileUploadService;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    protected $fileUploadService;
    public function __construct(FileUploadService $fileUploadService) {
        $this->fileUploadService = $fileUploadService;
    }
    public function upload(UploadFileRequest $request)
    {
        $data = $request->validated();
        try {
            $this->fileUploadService->upload($data);
            return response()->success(null, "success", ResponseStatus::CREATED);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteFile($id)
    {
        try {
            $this->fileUploadService->delete($id);
            return response()->success(null, "success", ResponseStatus::CREATED);
        } catch (\Exception $th) {
            return response()->error($th->getMessage(), ResponseStatus::INTERNAL_SERVER_ERROR);
        }
    }
}
