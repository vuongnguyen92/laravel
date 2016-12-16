<?php

use Illuminate\Database\Seeder;

class keyfilterTableSeeder extends Seeder
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
        $description = "Bad Word";
        DB::table('keyfilter')->insert([
        	['name' => 'Fuck','description' => $description,'status'=>$status],
        	['name' => 'Bitch','description' => $description,'status'=>$status],
        	['name' => 'Phắc','description' => $description,'status'=>$status],
        	['name' => 'Nện','description' => $description,'status'=>$status],
        	['name' => 'Chịch','description' => $description,'status'=>$status],
        	['name' => 'Cc','description' => $description,'status'=>$status],
        	['name' => 'Dkm','description' => $description,'status'=>$status],
        	['name' => 'Cl','description' => $description,'status'=>$status]
    	]);
    }
}
