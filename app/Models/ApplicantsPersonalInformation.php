<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsPersonalInformation extends Model
{
    use HasFactory;

    protected $primaryKey = 'personal_id';
    public $timestamps = false;

    protected $fillable = [
        'applicant_id',
        'first_name',
        'last_name',
        'contact',
        'birthday',
        'house_number',
        'street',
        'barangay',
        'municipality'
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
