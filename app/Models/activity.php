<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'name',
        'description'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
