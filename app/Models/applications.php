<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{

    protected $fillable = ['id','typeJob','employee','day','startDate','endDate','observation','status'];
    public $timestamps = false;
}
