<?php

namespace App\Repository;

use App\Interface\FacilityTimingRepositoryInterface;
use App\Models\FacilityTiming;
use Carbon\Carbon;

class FacilityTimingRepository implements FacilityTimingRepositoryInterface
{
    public function createOrUpdate($data)
    {
        return FacilityTiming::updateOrInsertTiming([
            "facility_location_id" => $data['facility_location_id'],
            "day_id" => $data['day_id'],
            "start_time" => $data["start_time"],
            "end_time" => $data["end_time"],
            "time_zone" => $data['time_zone'],
            "time_zone_string" => $data['time_zone_string'],
            "start_time_isb" => $data['start_time_isb'],
            "end_time_isb" => $data['end_time_isb'],
        ]);
    }

    public function deleteByConditionals($facilityLocationId, $exceptDayIds)
    {
        FacilityTiming::where('facility_location_id', $facilityLocationId)->whereNotIn('day_id', $exceptDayIds)->update([
            'deleted_at'=> Carbon::now(),
        ]);
    }
}
