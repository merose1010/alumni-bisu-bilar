<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AlumniMem;
use App\Models\AlumniID;
use App\Models\Reissueance;
use App\Models\User;


class Admin_Notifications extends Model
{
    use HasFactory;

    protected $table = 'admin_notification';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'alumniid_id',
        'alumnimem_id',
        'reissueance_id',
        'message',
        'read_at'
    ];

    public function alumniid()
    {
        return $this->belongsTo(AlumniID::class);
    }

    public function alumnimem()
    {
        return $this->belongsTo(AlumniMem::class);
    }

    public function reissueance()
    {
        return $this->belongsTo(Reissueance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
