<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
                'id'                => 1,
                'email'             => 'admin@admin.com',
                'first_name'        => 'admin',
                'last_name'         => 'admin',
                'skype'             => null,
                'age'               => 15,
                'path_to_avatar'    => 'imgs/icons/user.png',
                'password'          => Hash::make('123123123'),
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        User::insert($admin);
/*        $teachers = [
            [
                'id'                => 2,
                'email'             => 'anna@anna.com',
                'first_name'        => 'Анна',
                'last_name'         => 'Владимировна',
                'skype'             => 'anna123',
                'age'               => 25,
                'path_to_avatar'    => 'imgs/seeder/an.jpg',
                'password'          => Hash::make('123123123'),
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'                => 3,
                'email'             => 'dmitriy@dm.com',
                'first_name'        => 'Дмитрий',
                'last_name'         => 'Печора',
                'skype'             => 'dmitriy123',
                'age'               => 25,
                'path_to_avatar'    => 'imgs/seeder/dm.jpg',
                'password'          => Hash::make('123123123'),
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'                => 4,
                'email'             => 'vlad@vlad.com',
                'first_name'        => 'Влад',
                'last_name'         => 'Никифоров',
                'skype'             => 'vlad123',
                'age'               => 22,
                'path_to_avatar'    => 'imgs/seeder/vlad.jpg',
                'password'          => Hash::make('123123123'),
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id'                => 5,
                'email'             => 'elena@elena.com',
                'first_name'        => 'Елена',
                'last_name'         => 'Владимировна',
                'skype'             => 'elena123',
                'age'               => 25,
                'path_to_avatar'    => 'imgs/seeder/elena.jpg',
                'password'          => Hash::make('123123123'),
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        User::insert($teachers);*/
    }
}
