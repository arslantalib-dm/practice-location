<?php

namespace App\Interface;

interface FacilityBillingRepositoryInterface {

    public function createOrUpdate($id, $data);
}
