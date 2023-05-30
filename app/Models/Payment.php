<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment_settings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'reciever_name',
        'alumni_id_price',
        'alumni_mem_price',
        'gcash_no',
        'gcash_qr',
    ];

}
