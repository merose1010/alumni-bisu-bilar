<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniMem extends Model
{
    use HasFactory;
    protected $table = 'alumni_mem';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'address',
        'bday',
        'con_num',
        'fb',
        'user_id',
        'pay_med',
        'status',
        'signature',
        'reference_no',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
