<?php

namespace App\Exports;

use App\Models\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\ApplicantsAcademicInformation;
use App\Models\ApplicantsPersonalInformation;
use App\Notifications\StatusUpdateNotification; 
use App\Models\ApplicantsAcademicInformationChoice;
use App\Models\ApplicantsAcademicInformationGrade;
use App\Models\Member;
use Illuminate\Support\Carbon;


class ApplicantsExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Applicant::select(
            'applicants.created_at',
            'personal_info.first_name',
            'personal_info.last_name',
            'applicants.email',
            'personal_info.contact',
            'personal_info.birthday',
            'personal_info.house_number',
            'personal_info.street',
            'personal_info.barangay',
            'personal_info.municipality',
            'academic_info.incoming_grade_year',
            'academic_info.current_school',
            'academic_info.current_course_program_grade',
            'academic_info.current_school',
            'applicants.status' 
        )
        ->join('applicants_personal_information as personal_info', 'applicants.applicant_id', '=', 'personal_info.applicant_id')
        ->join('applicants_academic_information as academic_info', 'applicants.applicant_id', '=', 'academic_info.applicant_id')
        ->get()
        ->map(function ($item) {
            $item->created_at = Carbon::parse($item->created_at)->format('F d, Y H:i:s');
            $item->birthday = Carbon::parse($item->birthday)->format('F d, Y');
            return $item;
        });
    }
    
    public function headings(): array
    {
        return [
            'Date Applied',
            'First Name',
            'Last Name',
            'Email',
            'Contact Number',
            'Birthdate',
            'House Number',
            'Street',
            'Barangay',
            'Municipality',
            'Incoming Grade',
            'Current School',
            'Current Program',
            'Status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
       
        $sheet->getStyle('A1:M1')->applyFromArray([
            'font' => ['bold' => true],
        ]);

        foreach(range('A','M') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}