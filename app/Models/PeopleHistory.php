<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleHistory extends Model
{
    use HasFactory;

    protected $table = 'people_histories';

    protected $fillable = [
        'people_id',
        'history',
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
