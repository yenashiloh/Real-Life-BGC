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
}
