<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsAcademicInformation extends Model
{
    use HasFactory;

    protected $primaryKey = 'academic_id';
    public $timestamps = false;

    protected $fillable = [
        'applicant_id',
        'incoming_grade_year',
        'current_course_program_grade',
        'current_school'
    ];

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
