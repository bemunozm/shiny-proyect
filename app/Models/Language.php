<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Language extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function resumes(): BelongsToMany{
        return $this->belongsToMany(Resume::class)->withPivot('id','written_level', 'oral_level', 'weight');
    }
    
}
