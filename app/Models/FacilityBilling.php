<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityBilling extends Model
{
    use HasFactory;

    protected $fillable = [
        "facility_location_id",
        "provider_name",
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
        "npi",
        "tax_id_check",
        "tin",
        "ssn",
        "created_by",
        "updated_by",
        "dol",
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

    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at');
    }
}
