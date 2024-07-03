<?php

namespace App\Repository;
use App\Interface\FileRepositoryInterface;
use App\Models\File;

class FileRepository implements FileRepositoryInterface
{
    public function create($data) {
        return File::create($data);
    }

    public function findById($id) {
        return File::where('id', $id)->first();
    }

    public function delete($id) {
        return File::where('id', $id)->delete();
    }
}
