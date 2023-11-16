<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'provincias';

    public function comunas()
{
    return $this->hasMany(City::class);
}

public function region()
{
    return $this->belongsTo(Region::class);
}


}

