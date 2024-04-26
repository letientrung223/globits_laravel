<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'company_id'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function person()
    {
        return $this->belongsToMany(Person::class);
    }
}

