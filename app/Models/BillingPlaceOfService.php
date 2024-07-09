<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingPlaceOfService extends Model
{
    use HasFactory;

    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at');
    }

}
