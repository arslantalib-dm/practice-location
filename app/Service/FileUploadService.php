<?php

namespace App\Service;

use App\Enums\ResponseStatus;
use App\Interface\FileRepositoryInterface;
use App\Models\DocumentType;
use Carbon\Carbon;

class FileUploadService
{

    protected $fileRepository;
    public function __construct(
        FileRepositoryInterface $fileRepository
    ) {
        $this->fileRepository = $fileRepository;
    }

    public function upload($data)
    {
        $file = $data['signature_file'];

        if (!$file) {
        }
        // Get file details
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();
        // dd($originalName);
        // Create a unique file name
        $fileName = pathinfo($originalName, PATHINFO_FILENAME);
        $fileName = $fileName . '_' . time() . '.' . $extension;

        // Store file in 'storage/app/uploads' directory
        $path = $file->storeAs('uploads', $fileName);

        $document = DocumentType::where('name', $data['doc_type'])->first();

        $this->fileRepository->create([
            'reference_id' => $data['object_id'],
            'file_title' => $data['file_title'],
            'file_name' => $fileName,
            'file_link' => $path,
            'ext' => $extension,
            'document_type_id' => $document->id,
        ]);
    }

    public function delete($id)
    {
        $file = $this->fileRepository->findById($id);

        if (!$file) {
            throw new \Exception('Not Found', ResponseStatus::NOT_FOUND);
        }
        $this->fileRepository->delete($id);
    }
}
