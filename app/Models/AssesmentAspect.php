<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmentAspect extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subjec()
    {
        $this->belongsTo('App\Models\Subject');
    }
}
