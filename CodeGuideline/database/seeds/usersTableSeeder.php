<?php

use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= 10;$i++)
        {
        	DB::table('users')->insert(
	        	[
	        		'name' => 'Admin_'.$i,
	            	'email' => 'admin_'.$i.'@gmail.com',
	            	'password' => bcrypt('123456'),
	            	'level'=> 0,
	            	'created_at' => new DateTime(),
	        	]
        	);
        }
        for($i = 1; $i <= 10;$i++)
        {
        	DB::table('users')->insert(
	        	[
	        		'name' => 'Moderate'.$i,
	            	'email' => 'moderate'.$i.'@gmail.com',
	            	'password' => bcrypt('123456'),
	            	'level'=> 1,
	            	'created_at' => new DateTime(),
	        	]
        	);
        }
        for($i = 1; $i <= 10;$i++)
        {
        	DB::table('users')->insert(
	        	[
	        		'name' => 'Author'.$i,
	            	'email' => 'author'.$i.'@gmail.com',
	            	'password' => bcrypt('123456'),
	            	'level'=> 2,
	            	'created_at' => new DateTime(),
	        	]
        	);
        }
        for($i = 1; $i <= 10;$i++)
        {
        	DB::table('users')->insert(
	        	[
	        		'name' => 'User_'.$i,
	            	'email' => 'user_'.$i.'@gmail.com',
	            	'password' => bcrypt('123456'),
	            	'level'=> 3,
	            	'created_at' => new DateTime(),
	        	]
        	);
        }
    }
}
