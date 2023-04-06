<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['role_name'=>'Admin', 'role_desc'=>'Quản trị hệ thống'],
            ['role_name'=>'Confirm', 'role_desc'=>'Xác nhận đơn hàng'],
            ['role_name'=>'Content', 'role_desc'=>'Phát triển nội dung'],

        ]);
    }
}
