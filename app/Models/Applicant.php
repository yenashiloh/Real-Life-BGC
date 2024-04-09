<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Applicant extends Authenticatable
{
    protected $primaryKey = 'applicant_id';
    protected $table = 'applicants';

    protected $fillable = [
        'email',
        'password',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
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

    public function academicInformationGrade()
    {
        return $this->hasOne(ApplicantsAcademicInformationGrade::class, 'applicant_id', 'applicant_id');
    }

    public function academicInformationChoice()
    {
        return $this->hasOne(ApplicantsAcademicInformationChoice::class, 'applicant_id', 'applicant_id');
    }
    public function applicants_personal_information()
    {
        return $this->hasOne(ApplicantsPersonalInformation::class, 'applicant_id');
    }
    public function household()
    {
        return $this->hasOne(Household::class, 'applicant_id', 'applicant_id');
    }
    public function member()
    {
        return $this->hasOne(Member::class, 'applicant_id', 'applicant_id');
    }
    public function requirements()
    {
        return $this->hasOne(Requirement::class, 'applicant_id', 'applicant_id');
    }

    public function contentEmail()
    {
        return $this->hasOne(ContentEmail::class, 'applicant_id', 'applicant_id');
    }
}
