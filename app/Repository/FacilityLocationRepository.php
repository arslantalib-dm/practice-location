<?php

namespace App\Repository;

use App\Interface\FacilityLocationRepositoryInterface;
use App\Models\FacilityLocation;

class FacilityLocationRepository implements FacilityLocationRepositoryInterface
{
    public function createOrUpdate($id, $data) {
        $facility = FacilityLocation::find($id);
        if (!$facility) {
            $facility = FacilityLocation::create($data);
        } else {
            $facility->update($data);
        }
        return $facility;
    }
}
