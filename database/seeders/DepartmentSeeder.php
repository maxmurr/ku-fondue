<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = ['กองยานพาหนะ อาคาร และสถานที่','กองกิจการนิสิต','สำนักทะเบียนและประมวลผล','สำนักบริหารการศึกษา', 'สำนักงานมหาวิทยาลัย',
            'สำนักส่งเสริมและฝึกอบรม','สำนักบริการคอมพิวเตอร์','สำนักหอสมุด','สำนักการกีฬา','สำนักงานสภามหาวิทยาลัยเกษตรศาสตร์','สถานพยาบาลมหาวิทยาลัยเกษตรศาสตร์'];
        foreach ($departments as $department_name){
            $department = new Department();
            $department->name = $department_name;
            $department->save();
        }
    }
}
