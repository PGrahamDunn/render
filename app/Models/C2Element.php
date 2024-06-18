<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class C2Element extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function c2item(): BelongsTo
    {
        return $this->belongsTo(C2Item::class);
    }

    public function C2Designs(): HasMany
    {
        return $this->hasMany(C2Design::class);
    }
}
