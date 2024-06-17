<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'last_name',
        'img',
        'birth_date',
        'birth_place',
        'death_date',
        'death_place',
        'gender',
        'city',
        'country',
        'beheerder_id'
    ];
    public function parents()
    {
        return $this->belongsToMany(People::class, 'relations', 'child_id', 'parent_id');
    }
    public function children()
    {
        return $this->belongsToMany(People::class, 'relations', 'parent_id', 'child_id');
    }

    public function galleries()
    {
        return $this->hasMany(PeopleGallery::class);
    }

    public function histories()
    {
        return $this->hasMany(PeopleHistory::class);
    }
    
    public function beheerder()
    {
        return $this->belongsTo(User::class, 'beheerder_id');
    }

    public function marriages()
    {
        return $this->belongsToMany(People::class, 'people_marriages', 'person_id', 'spouse_id');
    }   
}
