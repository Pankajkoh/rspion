<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $table = 'industries';
    use HasFactory;
    
    const INACTIVE = 0;
    const ACTIVE = 1;
}
