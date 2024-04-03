<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_image'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
