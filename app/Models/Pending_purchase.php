<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pending_purchase extends Model
{
    use HasFactory;
    protected $table = "pending_purchase";
    protected $primaryKey = "id";
}
