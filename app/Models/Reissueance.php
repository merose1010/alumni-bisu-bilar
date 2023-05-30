<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reissueance extends Model
{
    use HasFactory;
    protected $table = 'reissueances';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'id_no',
        'degree',
        'reason',
        'or_no',
        'user_id',
        'signature',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
