<?php

use Illuminate\Database\Seeder;

class tagtopicTableSeeder extends Seeder
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
        $post_ids = \App\topic::pluck('id')->toArray();
        $tag_ids = \App\tag::pluck('id')->toArray();
        $datas = [];
        foreach (range(1, 200) as $key => $value) {
            $datas[] = [
                'topic_id' =>  $faker->randomElement($post_ids) ,
                'tag_id' =>  $faker->randomElement($tag_ids) ,
                'created_at' => new DateTime()
            ];
        }
        DB::table('tag_topic')->insert($datas);
    }
}
