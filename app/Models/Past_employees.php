<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Past_employees extends Model
{
    use HasFactory;
    protected $table = "past_employees";
    protected $primaryKey = "id";
}
