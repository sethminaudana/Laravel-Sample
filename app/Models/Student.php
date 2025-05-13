<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'email', 'date_of_birth', 'major']; // Added $fillable for mass assignment

}
