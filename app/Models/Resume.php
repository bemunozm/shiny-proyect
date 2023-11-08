<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resume extends Model
{


    use HasFactory;

    protected $fillable = ['user_id', 'replacement_id'];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function replacement(): BelongsTo{
        return $this->belongsTo(Replacement::class);
    }

    public function experiences(): HasMany{
        return $this->hasMany(Experience::class);
    }

    public function educations(): HasMany{
        return $this->hasMany(Education::class);
    }

    public function languages(): HasMany{
        return $this->hasMany(Language::class);
    }

    public function skills(): HasMany{
        return $this->hasMany(Skill::class);
    }

    public function replacements(): BelongsToMany{
        return $this->belongsToMany(Replacement::class)->withPivot('hired');
    }
}
