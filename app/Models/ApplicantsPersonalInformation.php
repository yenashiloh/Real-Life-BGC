<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsPersonalInformation extends Model
{
    use HasFactory;

    protected $primaryKey = 'applicant_id';
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'contact',
        'birthday',
        'house_number',
        'street',
        'barangay',
        'municipality'
    ];
}
