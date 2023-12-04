<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsAcademicInformationCollege extends Model
{
    use HasFactory;

    protected $primaryKey = 'applicant_id';

    protected $fillable = [
        'incoming_year',
        'current_course_program',
        'current_school',
        'grade_eleven_first_sem_gwa',
        'grade_eleven_second_sem_gwa',
        'grade_twelve_first_sem_gwa',
        'grade_twelve_second_sem_gwa',
        'first_year_first_sem_gwa',
        'first_year_second_sem_gwa',
        'second_year_first_sem_gwa',
        'second_year_second_sem_gwa'
    ];
}
