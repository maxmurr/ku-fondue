<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Problem>
 */
class ProblemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => fake()->randomElement(['การเดินทางภายในมหาวิทยาลัย', 'อุบัติเหตุ', 'ภัยพิบัติ', 'กองทุนเงินให้กู้ยืมเพื่อการศึกษา(กยศ.)', 'เหตุขัดข้องภายในมหาวิทยาลัย', 'อื่นๆ']),
            'status' => fake()->randomElement(['Ignored','Pending',
                'In Progress','Done']),
            'title' => fake()->sentence(4),
            'detail' => fake()->realText(30),
            'location'=> 'Kasetsart University',
            'department_id' => (rand(1,Department::all()->count())),
            'user_id' => null,
            'owner_id' => rand(1,User::all()->count()),
            'picture_path' => 'images/default.png',
            'category_id' => rand(1, Category::all()->count()),
        ];
    }
}
