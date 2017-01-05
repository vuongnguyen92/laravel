<?php

use Illuminate\Database\Seeder;

class favouriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        $topic_ids = \App\topic::pluck('id')->toArray();
        $user_ids = \App\user::pluck('id')->toArray();
        foreach (range(1, 100) as $key => $value) {
            $datas[] = [
            		'name' => "favourite ".$faker->word,
            		'idTopic' => $faker->randomElement($topic_ids),
	        		'idUser' => $faker->randomElement($user_ids),         		            	
	            	'created_at' => new DateTime()
	        	];
    	}
        DB::table('favourite')->insert($datas);
    }
}
