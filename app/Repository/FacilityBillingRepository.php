<?php

namespace App\Repository;

use App\Interface\FacilityBillingRepositoryInterface;
use App\Models\FacilityBilling;

class FacilityBillingRepository implements FacilityBillingRepositoryInterface
{
    public function createOrUpdate($id, $data) {
        $facility = FacilityBilling::find($id);
        if (!$facility) {
            $facility = FacilityBilling::create($data);
        } else {
            $facility->update($data);
        }
        return $facility;
    }
}
