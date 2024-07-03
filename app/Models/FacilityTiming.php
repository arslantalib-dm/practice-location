<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityTiming extends Model
{
    use HasFactory;

    protected $fillable = [
        "start_time",
        "end_time",
        "day_id",
        "facility_location_id",
        "time_zone",
        "time_zone_string",
        "start_time_isb",
        "end_time_isb",
        "created_by",
        "updated_by"
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($timing) {
            $timing->created_by = 1;
            $timing->created_at = Carbon::now();
            $timing->updated_at = Carbon::now();
        });

        static::updating(function ($timing) {
            $timing->updated_by = 1;
            $timing->updated_at = Carbon::now();
        });
    }

    public static function updateOrInsertTiming($data)
    {
        $exists = static::where('facility_location_id', $data['facility_location_id'])
            ->where('day_id', $data['day_id'])
            ->exists();

        if ($exists) {
            // Update existing record
            static::where('facility_location_id', $data['facility_location_id'])
                ->where('day_id', $data['day_id'])
                ->update($data);
        } else {
            static::create($data);
        }
    }

    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at');
    }
}
