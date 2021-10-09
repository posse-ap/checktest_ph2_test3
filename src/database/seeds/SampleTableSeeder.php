<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        $employee_count = 100;

        // 部署
        DB::table('depts')->delete();
        DB::table('depts')->insert([
            'dept_name' => '総務部',
            'created_at' => '2000/1/1',
            'updated_at' => '2000/1/1'
        ]);
        DB::table('depts')->insert([
            'dept_name' => '経理部',
            'created_at' => '2000/1/1',
            'updated_at' => '2000/1/1'
        ]);
        DB::table('depts')->insert([
            'dept_name' => '人事部',
            'created_at' => '2000/1/1',
            'updated_at' => '2000/1/1'
        ]);
        DB::table('depts')->insert([
            'dept_name' => '開発部',
            'created_at' => '2000/1/1',
            'updated_at' => '2000/1/1'
        ]);
        DB::table('depts')->insert([
            'dept_name' => '営業部',
            'created_at' => '2000/1/1',
            'updated_at' => '2000/1/1'
        ]);

        // 従業員
        DB::table('employees')->delete();
        $dept = ['1', '2', '3', '4', '5'];
        for ($i = 1; $i <= $employee_count; $i++) {
            DB::table('employees')->insert([
                'dept_id' => $faker->randomElement($dept),
                'name' => $faker->name(),
                'address' => $faker->address(),
                'email' => $faker->email(),
                'old' => $faker->numberBetween(21, 60),
                'tel' => $faker->phoneNumber(),
                'created_at' => '2000/1/1',
                'updated_at' => '2000/1/1'
            ]);
        }

        // 年収
        DB::table('salary')->delete();
        for ($i = 1; $i <= $employee_count; $i++) {
            DB::table('salary')->insert([
                'employee_id' => $i,
                'year' => 2019,
                'amount' => $faker->numberBetween($min = 200, $max = 1500),
                'created_at' => '2020/1/1',
                'updated_at' => '2020/1/1',
                'deleted_at' => '2020/1/5'
            ]);
            DB::table('salary')->insert([
                'employee_id' => $i,
                'year' => 2019,
                'amount' => $faker->numberBetween($min = 200, $max = 1200),
                'created_at' => '2020/1/5',
                'updated_at' => '2020/1/5'
            ]);
        }
        for ($i = 1; $i <= $employee_count; $i++) {
            DB::table('salary')->insert([
                'employee_id' => $i,
                'year' => 2020,
                'amount' => $faker->numberBetween($min = 200, $max = 1500),
                'created_at' => '2021/1/1',
                'updated_at' => '2021/1/1',
                'deleted_at' => '2021/1/5'
            ]);
            DB::table('salary')->insert([
                'employee_id' => $i,
                'year' => 2020,
                'amount' => $faker->numberBetween($min = 200, $max = 1200),
                'created_at' => '2021/1/5',
                'updated_at' => '2021/1/5'
            ]);
        }
    }
}
