<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Resume extends Model
{


    use HasFactory;

    protected $guarded = [];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function replacement(): BelongsTo{
        return $this->belongsTo(Replacement::class);
    }

    public function experiences(): HasMany{
        return $this->hasMany(Experience::class);
    }

    public function educations(): BelongsToMany{
        return $this->belongsToMany(Education::class)->withPivot('id','status', 'start_date', 'finish_date', 'weight');
    }

    public function languages(): BelongsToMany{
        return $this->belongsToMany(Language::class)->withPivot('id','written_level', 'oral_level', 'weight');
    }

    public function skills(): BelongsToMany{
        return $this->belongsToMany(Skill::class)->withPivot('id', 'weight');
    }

    public function replacements(): BelongsToMany{
        return $this->belongsToMany(Replacement::class);
    }

}
