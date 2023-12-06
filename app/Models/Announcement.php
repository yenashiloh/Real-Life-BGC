<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'caption', 
        'image', 
        'image_two',  
        'image_three',
        'image_four',
        'image_five',
        'image_six',
        'image_seven',
        'image_eight',
        'image_nine',
        'image_ten'

    ];
    protected $table = 'announcement';
    public $timestamps = true;

}
