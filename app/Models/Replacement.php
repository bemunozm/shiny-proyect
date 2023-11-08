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

    protected $fillable = [
        'job_name',
        'job_area',
        'job_sub_area',
        'country',
        'state',
        'city',
        'address',
        'job_description',
        'min_salary',
        'max_salary',
        'min_experience',
        'company_id'
    ];

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    }

    public function resumes(): BelongsToMany{
        return $this->belongsToMany(Resume::class)->withPivot('hired');
    }

    public function resume(): HasOne{
        return $this->hasOne(Resume::class);
    }
}
