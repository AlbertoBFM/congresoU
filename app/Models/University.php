<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'user',
        'password',
    ];

    public function delegate(){
        return $this->hasMany(Delegate::class);
    }

}
