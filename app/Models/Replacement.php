<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Replacement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    }

    public function resumes(): BelongsToMany{
        return $this->belongsToMany(Resume::class);
    }

    public function resume(): HasOne{
        return $this->hasOne(Resume::class);
    }
}
