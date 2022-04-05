<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_lastname',
        'm_lastname',
        'names',
        'ci',
        'd_birth',
        'user_id',
        'university_id',
        'commission_id'
    ];

    public function university(){
        return $this->belongsTo(University::class);
    }

}
