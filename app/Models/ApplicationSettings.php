<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationSettings extends Model
{
    use HasFactory;

    protected $table = 'application_settings';

    protected $guarded = ['id'];

    protected $fillable = ['start_date', 'start_time', 'max_number', 'current_status', 'stop_date', 'stop_time'];
}
