<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $primaryKey = 'members_id';
    public $timestamps = false;

    protected $fillable = [
        'applicant_id',
        'name',
        'relationship',
        'occupation',
        'monthly_income'
    ];

    public function household()
    {
        return $this->belongsTo(Household::class);
    }
}
