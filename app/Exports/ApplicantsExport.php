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
use App\Models\ApplicantsFamilyInformation;
use Illuminate\Support\Carbon;


class ApplicantsExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Applicant::select(
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
            'grades_info.latestAverage',
            'grades_info.latestGWA',
            'grades_info.scopeGWA',
            'grades_info.equivalentGrade',
            'choices.first_choice_school',
            'choices.second_choice_school',
            'choices.third_choice_school',
            'first_choice_course',
            'second_choice_course',
            'third_choice_course',
            'family_info.total_household_members',
            'family_info.father_occupation',
            'family_info.father_income',
            'family_info.mother_occupation',
            'family_info.mother_income',
            'family_info.total_support_received'
        )
        ->join('applicants_personal_information as personal_info', 'applicants.applicant_id', '=', 'personal_info.applicant_id')
        ->join('applicants_academic_information as academic_info', 'applicants.applicant_id', '=', 'academic_info.applicant_id')
        ->join('applicants_family_information as family_info', 'applicants.applicant_id', '=', 'family_info.applicant_id')
        ->join('applicants_academic_information_grades as grades_info', 'applicants.applicant_id', '=', 'grades_info.applicant_id')
        ->join('applicants_academic_information_choices as choices', 'applicants.applicant_id', '=', 'choices.applicant_id')
        ->whereNotIn('applicants.status', ['Approved', 'Declined'])
        ->get()
        ->map(function ($item) {
            $item->first_name = ucwords($item->first_name);
            $item->last_name = ucwords($item->last_name);
            $item->street = ucwords($item->street);
            $item->barangay = ucwords($item->barangay);
            $item->municipality = ucwords($item->municipality);
            $item->current_school = ucwords($item->current_school);
            $item->father_occupation = ucwords($item->father_occupation);
            $item->mother_occupation = ucwords($item->mother_occupation);
            $item->scopeGWA = ucwords($item->scopeGWA);
            $item->birthday = Carbon::parse($item->birthday)->format('F d, Y');
            return $item;
        });
    }
    
    public function headings(): array
    {
        return [
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
            'Current Course/Program',
            'Latest Average',
            'Latest General Average/GWA',
            'Scope General Average/GWA',
            'Equivalent Grade',
            'First Choice School',
            'Second Choice School',
            'Third Choice School',
            'First Choice Course',
            'Second Choice Course',
            'Third Choice Course',
            'Total Household Members',
            'Father Occupation',
            'Father Income',
            'Mother Occupation',
            'Mother Income',
            'Total Support Received'
        ];
    }

    public function styles(Worksheet $sheet)
{
    // Apply bold style to headers from A1 to AC1
    $sheet->getStyle('A1:AC1')->applyFromArray([
        'font' => ['bold' => true],
    ]);

    // Auto-size columns from A to Z
    foreach (range('A', 'Z') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Auto-size columns from AA to AC
    foreach (range('A', 'C') as $suffix) {
        $sheet->getColumnDimension('A' . $suffix)->setAutoSize(true);
    }
}

}