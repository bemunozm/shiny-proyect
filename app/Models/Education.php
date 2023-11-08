<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory;
    protected $fillable = ['career','country', 'type_of_study', 'area_of_study', 'institution', 'status', 'start_date', 'finish_date', 'resume_id'];
    public function resume(): BelongsTo{
        return $this->belongsTo(Resume::class);
    }
}
