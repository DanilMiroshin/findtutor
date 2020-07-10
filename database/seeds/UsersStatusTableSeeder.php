<?php

use Illuminate\Database\Seeder;
use App\Models\UserStatus;
use Carbon\Carbon;

class UsersStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vouser_id
     */
    public function run()
    {
        $admin_status = [
                'user_id'       => 1,
                'isApproved'    => 0,
                'isBanned'      => 0,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ];

        UserStatus::insert($admin_status);
/*        $teachers_status = [
            [
                'user_id'       => 2,
                'isApproved'    => 1,
                'isBanned'      => 0,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id'       => 3,
                'isApproved'    => 1,
                'isBanned'      => 0,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id'       => 4,
                'isApproved'    => 1,
                'isBanned'      => 0,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id'       => 5,
                'isApproved'    => 1,
                'isBanned'      => 0,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        UserStatus::insert($teachers_status);*/
    }
}
