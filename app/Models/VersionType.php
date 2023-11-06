<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VersionType extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function versionnotes(): HasMany
    {
        return $this->hasMany(VersionNote::class);
    }

}
