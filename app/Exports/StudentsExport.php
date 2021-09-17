<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Auth;

class StudentsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
     public function __construct(int $id) {
        $this->id = $id;
    }

    public function collection()
    {
        $student = Student::orderBy('lastname','ASC')->where('idGrade','=',$this->id)->get();
        return $student;
    }
    public function headings(): array
    {
        return [
            'ID',
            'Firstname',
            'Lastname',
            'Gender',
            'Email',
            'Phone',
            'Password',
            'Address',
            'DOB',
            'Status',
            'Grade',
            'Scholarship',
            'TypePay',
        ];
    }
}