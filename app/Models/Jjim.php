<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jjim extends Model
{
    use HasFactory;

    protected $table = 'jjims';
    protected $fillable = ['s_no', 'u_no'];
}
