<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';
    use HasFactory;

    const status = [
        1 => 'Active',
        0 => 'Inactive',
    ];
}
