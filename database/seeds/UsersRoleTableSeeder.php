<?php

use Illuminate\Database\Seeder;
use App\Models\UserRole;
use Carbon\Carbon;

class UsersRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_roles = [
                'user_id'       => 1,
                'role'          => 'student',
                'isAdmin'       => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
        ];
        UserRole::insert($users_roles);
/*        $teachers_roles = [
            [
                'user_id'       => 2,
                'role'          => 'teacher',
                'isAdmin'       => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id'       => 3,
                'role'          => 'teacher',
                'isAdmin'       => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id'       => 4,
                'role'          => 'teacher',
                'isAdmin'       => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id'       => 5,
                'role'          => 'teacher',
                'isAdmin'       => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        UserRole::insert($teachers_roles);*/
    }
}
