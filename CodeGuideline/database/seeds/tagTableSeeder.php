<?php

use Illuminate\Database\Seeder;

class tagTableSeeder extends Seeder
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
        DB::table('tag')->insert([
        	['name' => 'test','description' => 'test','status'=>$status],
        	['name' => 'coding','description' => 'coding computer','status'=>$status],
        	['name' => 'word','description' => 'word word','status'=>$status],
        	['name' => 'foot','description' => 'foot','status'=>$status],
        	['name' => 'mu','description' => 'mu sport','status'=>$status],
        	['name' => 'mc','description' => 'mc sport','status'=>$status]
    	]);
    }
}