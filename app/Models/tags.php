<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    protected $fillable = ['name','id'];
    public $timestamps = false;
}
