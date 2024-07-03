<?php

namespace App\Interface;

interface FacilityRepositoryInterface {

    public function create($data);
    public function update($id, $data);
    public function find($id);
}
