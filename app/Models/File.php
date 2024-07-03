<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = "file";

    protected $fillable = [
        "reference_id",
        'file_title',
        'file_name',
        'file_link',
        'ext',
        'document_type_id',
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
}
