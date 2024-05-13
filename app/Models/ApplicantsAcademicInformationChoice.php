<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsAcademicInformationChoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'choice_id';
    public $timestamps = false;

    protected $fillable = [
        'applicant_id',
        'first_choice_school',
        'second_choice_school',
        'third_choice_school',
        'first_choice_course',
        'second_choice_course',
        'third_choice_course',
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
