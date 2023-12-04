<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $primaryKey = 'applicant_id';

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function personalInformation()
    {
        return $this->hasOne(ApplicantsPersonalInformation::class, 'applicant_id', 'applicant_id');
    }

    public function academicInformation()
    {
        return $this->hasOne(ApplicantsAcademicInformation::class, 'applicant_id', 'applicant_id');
    }

    public function academicInformationCollege()
    {
        return $this->hasOne(ApplicantsAcademicInformationCollege::class, 'applicant_id', 'applicant_id');
    }

    public function academicInformationChoice()
    {
        return $this->hasOne(ApplicantsAcademicInformationChoice::class, 'applicant_id', 'applicant_id');
    }
}
