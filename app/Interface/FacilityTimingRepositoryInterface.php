<?php

namespace App\Interface;

interface FacilityTimingRepositoryInterface {

    public function createOrUpdate($data);

    public function deleteByConditionals($facilityLocationId, $exceptDayIds);
}
