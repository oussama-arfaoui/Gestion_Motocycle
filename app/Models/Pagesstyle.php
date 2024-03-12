<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pagesstyle extends Model
{
    protected $table = 'pages_style';
    use HasFactory;
    protected $fillable = ['name', 'style'];

    
}