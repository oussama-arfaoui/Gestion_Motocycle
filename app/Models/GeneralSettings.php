<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralSettings extends Model
{
    use HasFactory;
    protected $table = 'general_settings'; // Set the table name if it's different from the default
    
    protected $fillable = [
        'logo',
        'favicon',
        'login_screen_background',
        'title',
        'name',
        'email',
    ];

    // You can define any relationships or additional methods here if needed
}
