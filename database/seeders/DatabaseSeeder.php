<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // $groupId = DB::table('groups')->insertGetId([
        //     'name'=>'Admin',
        //     'user_id'=>0,
        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s'),
        // ]);

        
        // if($groupId>0){
        //     $userId = DB::table('users')->insertGetId([
        //         'name'=>'TienHai',
        //         'group_id'=>$groupId,
        //         'email'=>'tienhai488@gmail.com',
        //         'password'=>Hash::make('12345678'),
        //         'user_id'=>0,
        //         'created_at'=>date('Y-m-d H:i:s'),
        //         'updated_at'=>date('Y-m-d H:i:s'),
        //     ]);
            
        //     DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //     if($userId>0){
        //         DB::table('posts')->insertGetId([
        //             'title'=>"Bai viet thu 1",
        //             'content'=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        //             'user_id'=>$userId,
        //             'created_at'=>date('Y-m-d H:i:s'),
        //             'updated_at'=>date('Y-m-d H:i:s'),
        //         ]);
        //     }
        // }

        DB::table('modules')->insert([
            'name'=>'users',
            'title'=>'Quản lý người dùng',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        DB::table('modules')->insert([
            'name'=>'groups',
            'title'=>'Quản lý nhóm',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        DB::table('modules')->insert([
            'name'=>'posts',
            'title'=>'Quản lý bài viết',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}