<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_in extends Model
{
    use HasFactory;
    protected $table = "purchase_in";
    protected $primaryKey = "id";
}
