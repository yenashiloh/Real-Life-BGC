<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'applicant_id',
        'document_type',
        'notes',
        'uploaded_document',
        'status'
    ];
    
    public function applicant()
{
    return $this->belongsTo(ApplicantsPersonalInformation::class, 'applicant_id');
}

}

