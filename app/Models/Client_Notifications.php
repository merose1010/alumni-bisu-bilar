<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Client_Notifications extends Model
{
    use HasFactory;

    protected $table = 'client_notification';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'message',
        'read_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
