<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cars extends Model
{

    protected $fillable = ['id','plate','brand','kind',"nameOwner","idOwner"];
    public $timestamps = false;
}
