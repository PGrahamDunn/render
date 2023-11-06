<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VersionNote extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    public function version_type(): BelongsTo
    {
        return $this->belongsTo(VersionType::class);
    }
}
