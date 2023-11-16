<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'corporate_name',
        'tax',
        'document',
        'verifier_code' ,
        'street_name' ,
        'number' ,
        'city' ,
        'phone' ,
        'industry', 
        'user_id' 
    ];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function replacements(): HasMany{
        return $this->hasMany(Replacement::class);
    }
}
