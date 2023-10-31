<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pending_sales extends Model
{
    use HasFactory;
    protected $table = "pending_sales";
    protected $primaryKey = "id";
}
