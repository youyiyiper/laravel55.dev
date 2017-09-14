<?php

use Illuminate\Database\Seeder;

class SidebarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sidebars')->insert([
            'name' => '系统设置',
            'purview_flag' => '',
            'is_active' => '0',
            'pid' => '0',
            'url' => '',
            'created_at' => '2017-09-14 17:08:21',
            'updated_at' => '2017-09-14 17:08:21',
        ]);

        DB::table('sidebars')->insert([
            'name' => '角色列表',
            'purview_flag' => 'rbac_role_index',
            'is_active' => '0',
            'pid' => '1',
            'url' => 'admin/role',
            'created_at' => '2017-09-14 17:08:21',
            'updated_at' => '2017-09-14 17:08:21',
        ]);

        DB::table('sidebars')->insert([
            'name' => '权限列表',
            'purview_flag' => 'rbac_privilege_index',
            'is_active' => '0',
            'pid' => '1',
            'url' => 'admin/privilege',
            'created_at' => '2017-09-14 17:08:21',
            'updated_at' => '2017-09-14 17:08:21',
        ]);

        DB::table('sidebars')->insert([
            'name' => '菜单列表',
            'purview_flag' => 'rbac_sidebar_index',
            'is_active' => '0',
            'pid' => '1',
            'url' => 'admin/sidebar',
            'created_at' => '2017-09-14 17:08:21',
            'updated_at' => '2017-09-14 17:08:21',
        ]);

        DB::table('sidebars')->insert([
            'name' => '管理员列表',
            'purview_flag' => 'rabc_admin_index',
            'is_active' => '0',
            'pid' => '1',
            'url' => 'admin/admin',
            'created_at' => '2017-09-14 17:08:21',
            'updated_at' => '2017-09-14 17:08:21',
        ]);

        DB::table('sidebars')->insert([
            'name' => '文章管理',
            'purview_flag' => '',
            'is_active' => '0',
            'pid' => '0',
            'url' => '',
            'created_at' => '2017-09-14 17:08:21',
            'updated_at' => '2017-09-14 17:08:21',
        ]);

        DB::table('sidebars')->insert([
            'name' => '文章分类',
            'purview_flag' => 'category_index',
            'is_active' => '0',
            'pid' => '6',
            'url' => 'admin/category',
            'created_at' => '2017-09-14 17:08:21',
            'updated_at' => '2017-09-14 17:08:21',
        ]);

        DB::table('sidebars')->insert([
            'name' => '文章列表',
            'purview_flag' => 'article_index',
            'is_active' => '0',
            'pid' => '6',
            'url' => 'admin/article',
            'created_at' => '2017-09-14 17:08:21',
            'updated_at' => '2017-09-14 17:08:21',
        ]);

        DB::table('sidebars')->insert([
            'name' => '标签列表',
            'purview_flag' => 'tag_index',
            'is_active' => '0',
            'pid' => '6',
            'url' => 'admin/tag',
            'created_at' => '2017-09-14 17:08:21',
            'updated_at' => '2017-09-14 17:08:21',
        ]);
    }
}
