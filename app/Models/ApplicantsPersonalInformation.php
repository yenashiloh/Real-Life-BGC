<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsPersonalInformation extends Model
{
    use HasFactory;

    protected $primaryKey = 'personal_id';
    public $timestamps = false;

    protected $fillable = [
        'applicant_id',
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
