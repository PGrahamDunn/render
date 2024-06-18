<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class C2Item extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function C2Elements(): HasMany
    {
        return $this->hasMany(C2Element::class);
    }
}
