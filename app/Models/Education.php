<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Education extends Model
{
    use HasFactory;
    protected $fillable = ['career', 'type_of_study', 'area_of_study', 'institution', 'subarea_of_study'];
    public function resumes(): BelongsToMany{
        return $this->belongsToMany(Resume::class)->withPivot('id','status', 'start_date', 'finish_date', 'weight');
    }
}
