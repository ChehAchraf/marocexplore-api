<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class itinerary extends Model
{
    use HasFactory;
    protected $fillable = ['title','duration','user_id','image'];

    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function destinations() : HasMany{
        return $this->Hasmany(destination::class);
    }
}
