<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'review',
    ];

    public function Period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }
}
