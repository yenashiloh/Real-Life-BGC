<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsAcademicInformationChoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'applicant_id';
    public $timestamps = false;

    protected $fillable = [
        'first_choice_school',
        'second_choice_school',
        'third_choice_school',
        'first_choice_course',
        'second_choice_course',
        'third_choice_course',
    ];
}
