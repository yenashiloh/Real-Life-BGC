<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsFamilyInformation extends Model
{
    protected $fillable = [
        'family_id',
        'applicant_id',
        'total_household_members',
        'father_occupation',
        'father_income',
        'mother_occupation',
        'mother_income',
        'total_support_received',
    ];
}
