<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18
 * Time: 15:06
 */

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('654321'),
        'remember_token' => str_random(10),
        'status' => '1',
        'headimg' => 'asset_admin/assets/img/user-1.jpg',
    ];
});