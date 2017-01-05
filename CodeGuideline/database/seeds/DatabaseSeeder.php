<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(usersTableSeeder::class);
        $this->call(catagoryTableSeeder::class);
        $this->call(topicTableSeeder::class);
        $this->call(tagTableSeeder::class);
        $this->call(tagtopicTableSeeder::class);
        $this->call(commentTableSeeder::class);
        $this->call(keyfilterTableSeeder::class);
        $this->call(favouriteTableSeeder::class);
    }
}
