<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "qualifier",
        "generate_document_using",
        "created_by",
        "updated_by",
        "is_active",
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($facility) {
            $facility->slug = str_replace(' ', '-', $facility->name);
            $facility->created_by = 1;
        });

        static::updating(function ($facility) {
            $facility->slug = str_replace(' ', '-', $facility->name);
            $facility->updated_by = 1;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }

    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at');
    }
}
