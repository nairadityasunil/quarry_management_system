<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel_available extends Model
{
    use HasFactory;
    protected $table = "fuel_available";
    protected $primaryKey = "id";
}
