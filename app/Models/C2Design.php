<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class C2Design extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function c2element(): BelongsTo
    {
        return $this->belongsTo(C2Element::class);
    }
}
