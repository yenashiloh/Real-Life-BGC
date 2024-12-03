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
        'equivalentGrade',
        'schoolGrade',   
        'yearLevel',         
        'generalAverage', 
    ];
}
