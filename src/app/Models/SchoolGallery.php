<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolGallery extends Model
{
    use HasFactory;

    // Define any fillable fields if necessary
    protected $fillable = ['title', 'description', 'image_path'];
}
