<?php

namespace App\Interface;

interface FileRepositoryInterface {

    public function create($data);
    public function findById($id);
    public function delete($id);
}
