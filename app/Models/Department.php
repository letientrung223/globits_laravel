<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable= ['code','name','parent_id','company_id'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function children()
    {
        return $this->hasMany(Department::class,'parent_id');
    }

}
