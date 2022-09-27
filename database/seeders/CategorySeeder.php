<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Problem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::first();
        if (!$category){
            $this->command->line("Generating Categories");
            $categories = ['กองยานพาหนะ อาคาร และสถานที่','กองกิจการนิสิต','สำนักทะเบียนและประมวลผล','สำนักบริหารการศึกษา', 'สำนักงานมหาวิทยาลัย',
                'สำนักส่งเสริมและฝึกอบรม','สำนักบริการคอมพิวเตอร์','สำนักหอสมุด','สำนักการกีฬา','สำนักงานสภามหาวิทยาลัยเกษตรศาสตร์','สถานพยาบาลมหาวิทยาลัยเกษตรศาสตร์',
                'Ignored','Pending', 'In Progress','Done'];
            collect($categories)->each(function ($category_name, $key){
                $category = new Category();
                $category->name = $category_name;
                $category->save();
            });
        }

        $problems = Problem::all();
        foreach($problems as $problem){
            $problem->category_id = rand(1, Category::all()->count());
        }
    }
}
