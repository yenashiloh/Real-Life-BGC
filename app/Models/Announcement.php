<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'caption'
    ];
    protected $table = 'announcement';
    public $timestamps = true;

}
