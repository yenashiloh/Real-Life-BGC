<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantAttendance extends Model
{
    use HasFactory;

    protected $table = 'applicant_attendance'; 

    protected $primaryKey = 'attendance_id'; 

    protected $fillable = [
        'applicant_id',
        'attend_orientation',
        'orientation_date',
        'orientation_proof',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}