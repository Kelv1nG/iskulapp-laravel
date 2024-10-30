<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'mobile',
        'email',
        'website',
        'logo',
        'address',
        'address',
        'address',
    ];
}
