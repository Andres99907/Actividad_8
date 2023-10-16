<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = ['Name', 'Asistentes'];
    public $timestamps = false; // Desactiva el registro de tiempo
}
