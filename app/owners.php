<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class owners extends Model
{

    protected $fillable = ['id','name','phone','address'];
}
