<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail_report extends Model
{
    use HasFactory;
    protected $table = "mail_report";
    protected $primaryKey = "id";
}
