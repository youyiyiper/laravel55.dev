<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminsRole extends Model
{
    protected $table = 'admins_roles';

    public $timestamps = false;  

    protected $fillable = [
        'admin_id',
        'role_id',
    ];
}
