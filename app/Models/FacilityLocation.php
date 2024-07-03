<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        "facility_id",
        "name",
        "address",
        "city",
        "state",
        "zip",
        "floor",
        "phone",
        "email",
        "ext_no",
        "cell_no",
        "fax",
        "is_main",
        "same_as_provider",
        "office_hours_start",
        "office_hours_end",
        "lat",
        "long",
        "day_list",
        "place_of_service_id",
        "qualifier",
        "created_by",
        "dean",
        "sate_id",
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($location) {
            $location->created_by = 1;
        });

        static::updating(function ($location) {
            $location->updated_by = 1;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }

    public function scopeNotMain($query)
    {
        return $query->where('is_main',0);
    }

    public function scopeMain($query)
    {
        return $query->where('is_main',1);
    }

    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function billing()
    {
        return $this->hasMany(FacilityBilling::class);
    }

    public function timing()
    {
        return $this->hasMany(FacilityTiming::class);
    }
}
