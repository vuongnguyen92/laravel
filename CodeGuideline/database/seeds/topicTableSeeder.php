<?php

use Illuminate\Database\Seeder;

class topicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        $category_ids = \App\catagory::pluck('id')->toArray();
        $datas = [];
        foreach (range(1, 100) as $key => $value) {
            $datas[] = [
            'tittle' =>  $faker->sentence ,
            'shortdescription' => $faker->text,
            'content' =>  $faker->paragraph(4) ,
            'image' => 'FPT-2.jpg',
            'status' => rand(0,1),
            'idCatagory' => $faker->randomElement($category_ids),
            'viewed' => rand(1,99), 'idCatagory' => rand(1,10), 'approvestatus' => rand(1,2), 'approvedby' => 'Admin_1', 'idUser'=> rand(21,30),
            'created_at' => new DateTime()];
        }
        DB::table('topic')->insert($datas);      
    }
}
