<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_users extends Model
{
    use HasFactory;
    protected $table = "admin_users";
    protected $primaryKey = "id";
}
