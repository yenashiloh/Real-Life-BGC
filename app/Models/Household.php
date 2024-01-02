<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $primaryKey = 'household_id';
    public $timestamps = false;

    protected $fillable = [
        'applicant_id',
        'total_members',
        'payslip_path'
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
