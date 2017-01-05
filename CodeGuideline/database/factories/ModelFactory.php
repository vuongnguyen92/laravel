<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\topic::class, function (Faker\Generator $faker) {
	   $content = "
    	</h3>Nội dung tin tức: Demo Project Laravel 5.3</h3>
    	<p>
    	<b>Địa chỉ </b>: TPHCM<br>
    	<b>Website</b>: http://codeguideline.nv<br>
    	</p>
    	";

    return ['tittle' => 'Lần đầu ĐH FPT cấp học bổng tiến sĩ ','shortdescription' => 'Bên cạnh 400 suất học bổng Nguyễn Văn Đạo, ĐH FPT lần đầu tiên chọn ra 30 học sinh xuất sắc nhất để cấp học bổng toàn phần đào tạo từ cử nhân lên thẳng tiến sĩ, với tổng giá trị quỹ lên tới 5 triệu USD.','content' => $content,'image' => 'FPT-2.jpg','status' => 1,'viewed' => rand(1,99), 'idCatagory' => rand(1,9), 'approvestatus' => 1, 'approvedby' => 'Admin_1', 'idUser'=> 21,'created_at' => new DateTime()];
});

$factory->define(App\tag::class, function (Faker\Generator $faker) {
	   $status = 1;

    return  ['name' => 'test'.rand(1,100),'description' => 'test'.rand(1,100),'status'=>$status];
});