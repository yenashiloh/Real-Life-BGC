<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentEmail extends Model
{
    protected $primaryKey = 'content_id';
    protected $fillable = [
        'content_id',
        'under_review',
        'shortlisted',
        'interview',
        'house_visitation',
        'decline',
    ];
    protected $table = 'email_content';
    public $timestamps = true;

}
