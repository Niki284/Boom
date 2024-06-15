<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleMarriage extends Model
{
    use HasFactory;

    protected $table = 'people_marriages';
    protected $fillable = [
        'person_id',
        'spouse_id',
    ];

    

    public function person()
    {
        return $this->belongsTo(People::class, 'person_id');
    }

    public function spouse()
    {
        return $this->belongsTo(People::class, 'spouse_id');
    }

    
}
