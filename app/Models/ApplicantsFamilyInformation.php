<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsFamilyInformation extends Model
{
    use HasFactory;

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
    
    public function applicant()
    {
        return $this->belongsTo(ApplicantsPersonalInformation::class, 'applicant_id');
    }
    public function personalInformation()
    {
        return $this->hasOne(ApplicantsPersonalInformation::class, 'applicant_id', 'applicant_id');
    }

    public function academicInformation() {
        return $this->hasOne(ApplicantsAcademicInformation::class, 'applicant_id');
    }

    public function choices()
    {
        return $this->hasMany(ApplicantsAcademicInformationChoice::class, 'applicant_id');
    }

    public function grades()
    {
        return $this->hasMany(ApplicantsAcademicInformationGrade::class, 'applicant_id');
    }

}
