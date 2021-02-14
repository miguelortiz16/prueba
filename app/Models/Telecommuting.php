<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telecommuting extends Model
{

    protected $fillable = ['idType','name','status','observation'];
    public $timestamps = false;
}
