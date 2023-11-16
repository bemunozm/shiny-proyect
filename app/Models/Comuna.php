<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'comunas';

    public function provincia()
{
    return $this->belongsTo(Province::class);
}

}
