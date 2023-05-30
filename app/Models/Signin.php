<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signin extends Model
{
    use HasFactory;
    protected $table = 'signin';
    protected $primaryKey = 'id';
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'course',
        'email',
        'password',
        'gender',
        'address'
    ];
}
