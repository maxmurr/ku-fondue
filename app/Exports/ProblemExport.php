<?php

namespace App\Exports;

use App\Models\Problem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProblemExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Problem::all('id','type','status','title','detail','location',
            'department_id','user_id','created_at','updated_at','deleted_at');
    }

    public function headings(): array
    {
        return ['problem_id','type','status','title','detail','location',
            'response_department','resolved_by','created_at','update_at','deleted_at'];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->type,
            $row->status,
            $row->title,
            $row->detail,
            $row->location,
            $row->department->name,
            $row->user?->name,
            $row->created_at,
            $row->updated_at,
            $row->deleted_at,
        ];
    }
}
