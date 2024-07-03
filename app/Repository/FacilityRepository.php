<?php

namespace App\Repository;
use App\Interface\FacilityRepositoryInterface;
use App\Models\Facility;

class FacilityRepository implements FacilityRepositoryInterface
{
    public function create($data) {
        return Facility::create($data);
    }

    public function update($id, $data) {
        return Facility::where('id', $id)->update($data);
    }

    public function find($id) {
        return Facility::find($id);
    }
}
