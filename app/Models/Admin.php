<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // ...
    
    protected $guard = 'admins'; 

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'contact_number'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'admins';
    protected $primaryKey = 'id';
    public $timestamps = true;

    
}


