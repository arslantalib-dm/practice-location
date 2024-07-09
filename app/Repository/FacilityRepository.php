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
        $facility = $this->find($id);
        $facility->update($data);
        return $facility;
    }

    public function find($id) {
        return Facility::find($id);
    }
}
