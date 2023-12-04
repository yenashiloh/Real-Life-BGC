<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsAcademicInformation extends Model
{
    use HasFactory;

    protected $primaryKey = 'applicant_id';

    protected $fillable = [
        'incoming_grade',
        'current_course_program',
        'current_school',
        'grade_three_gwa',
        'grade_four_gwa',
        'grade_five_gwa',
        'grade_six_gwa',
        'grade_seven_gwa',
        'grade_eight_gwa',
        'grade_nine_gwa',
        'grade_ten_gwa'
    ];
}
