<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Teacher;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            [
                'user_id'           => 2,
                'subject'           => 'Химия',
                'price'             => '100',
                'path_to_document'  => 'imgs/icons/example-doc.png',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id'           => 3,
                'subject'           => 'Математика',
                'price'             => '100',
                'path_to_document'  => 'imgs/icons/example-doc.png',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id'           => 4,
                'subject'           => 'Математика',
                'price'             => '200',
                'path_to_document'  => 'imgs/icons/example-doc.png',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id'           => 5,
                'subject'           => 'Русский язык',
                'price'             => '100',
                'path_to_document'  => 'imgs/icons/example-doc.png',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Teacher::insert($teachers);
    }
}
