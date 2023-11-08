<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'written_level',
        'oral_level',
        'resume_id'
    ];
    public function resume(): BelongsTo{
        return $this->belongsTo(Resume::class);
    }
}
