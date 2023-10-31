<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_out extends Model
{
    use HasFactory;
    protected $table = "purchase_out";
    protected $primaryKey = "id";
}
