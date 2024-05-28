<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsAcademicInformationGrade extends Model
{
    use HasFactory;

    protected $primaryKey = 'grade_id';
    public $timestamps = false;

    protected $fillable = [
        'applicant_id',
        'latestAverage',
        'latestGWA',
        'scopeGWA',
        'equivalentGrade',
        'grade_3_gwa',
        'grade_4_gwa',
        'grade_5_gwa',
        'grade_6_gwa',
        'grade_7_gwa',
        'grade_8_gwa',
        'grade_9_gwa',
        'grade_10_gwa',
        'grade_11_sem1_gwa',
        'grade_11_sem2_gwa',
        'grade_11_sem3_gwa',
        'grade_11_sem4_gwa',
        'grade_12_sem1_gwa',
        'grade_12_sem2_gwa',
        'grade_12_sem3_gwa',
        'grade_12_sem4_gwa',
        '1st_year_sem1_gwa',
        '1st_year_sem2_gwa',
        '1st_year_sem3_gwa',
        '1st_year_sem4_gwa',
        '2nd_year_sem1_gwa',
        '2nd_year_sem2_gwa',
        '2nd_year_sem3_gwa',
        '2nd_year_sem4_gwa'
    ];
}
