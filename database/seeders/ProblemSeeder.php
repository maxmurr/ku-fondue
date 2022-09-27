<?php

namespace Database\Seeders;

use App\Models\Problem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Problem::factory(50)->create();

        $problems = Problem::all();
        foreach ($problems as $problem)
            $problem->user_upvotes()->sync(array_rand(User::all()->toArray(), rand(1,20)));
    }
}
