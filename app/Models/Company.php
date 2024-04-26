<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
      protected $fillable = [
        'id',
        'name',
        'code',
        'address',
    ];
    public function persons()
    {
        return $this->hasMany(Person::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
