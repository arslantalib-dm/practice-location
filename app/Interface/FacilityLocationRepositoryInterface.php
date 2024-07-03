<?php

namespace App\Interface;

interface FacilityLocationRepositoryInterface {

    public function createOrUpdate($id, $data);
}
