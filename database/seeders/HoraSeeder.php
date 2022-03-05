<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class HoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('horas')->insert(['hora' => 10]);
        DB::table('horas')->insert(['hora' => 11]);
        DB::table('horas')->insert(['hora' => 12]);
        DB::table('horas')->insert(['hora' => 13]);
        DB::table('horas')->insert(['hora' => 17]);
        DB::table('horas')->insert(['hora' => 18]);
        DB::table('horas')->insert(['hora' => 19]);
        DB::table('horas')->insert(['hora' => 20]);
    }
}
