<?php

use Illuminate\Database\Seeder;

class catagoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $status = 1 ;
        DB::table('catagory')->insert([
        	['name' => 'Society','description' => 'Society','status'=>$status],
        	['name' => 'World','description' => 'World','status'=>$status],
        	['name' => 'Business','description' => 'Business','status'=>$status],
        	['name' => 'Cultural','description' => 'Cultural','status'=>$status],
        	['name' => 'Sport','description' => 'Sport','status'=>$status],
        	['name' => 'Law','description' => 'Law','status'=>$status],
        	['name' => 'Life','description' => 'Life','status'=>$status],
        	['name' => 'Course','description' => 'Course','status'=>$status],
        	['name' => 'Computer','description' => 'Computer','status'=>$status]
    	]);
    }
}
