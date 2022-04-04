<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'm_lastname',
        'name',
        'ci',
        'f_nac',
        'user_id',
        'university_id',
        'commission_id'
    ];

    public function university(){
        return $this->belongsTo(University::class);
    }

}
