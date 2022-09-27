<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', 'admin@example.com')->first();
        if (!$admin) {
            $admin = new User();
            $admin->name = "Empty";
            $admin->role = 'ADMIN';
            $admin->email = 'empty@example.com';
            $admin->password = Hash::make('emptypass');
            $admin->save();
        }

        $user = User::where('email', 'user01@example.com')->first();
        if (!$user) {
            $user = new User();
            $user->name = "user01";
            $user->role = 'USER';
            $user->email = 'user01@example.com';
            $user->password = Hash::make('userpass');
            $user->save();
        }

        $employee = User::where('email', 'employee01@example.com')->first();
        if (!$employee) {
            $employee = new User();
            $employee->name = "employee01";
            $employee->role = 'EMPLOYEE';
            $employee->email = 'employee01@example.com';
            $employee->department_id = 1;
            $employee->password = Hash::make('employeepass');
            $employee->save();
        }

        $employee = User::where('email', 'employee02@example.com')->first();
        if (!$employee) {
            $employee = new User();
            $employee->name = "employee02";
            $employee->role = 'EMPLOYEE';
            $employee->email = 'employee02@example.com';
            $employee->department_id = 1;
            $employee->password = Hash::make('employeepass');
            $employee->save();
        }

        User::factory(50)->create();
    }
}
