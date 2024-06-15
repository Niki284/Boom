<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleGallery extends Model
{
    use HasFactory;

    protected $table = 'people_galleries';
    
    protected $fillable = [
        'people_id',
        'images',
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    
}
