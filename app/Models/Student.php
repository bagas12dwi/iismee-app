<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    use HasFactory;

    public function getRouteKeyName(): string
    {
        return 'name';
    }

    protected $guarded = ['id'];

    public function internship()
    {
        return $this->hasMany('App\Models\Internship');
    }
}
