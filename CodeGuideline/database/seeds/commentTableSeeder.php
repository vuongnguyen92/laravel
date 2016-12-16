<?php

use Illuminate\Database\Seeder;

class commentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $content = array(
    		'Bài viết rất hay',
    		'Tôi rất thích bài viết này',
    		'Bài viết này tạm ổn',
    		'Hay quá trời',
    		'Tôi sẽ học thèo bài viết này',
    		'Bài viết này chưa được hay lắm',
    		'Ý kiến của tôi khác so với bài này',
    		'Bài viết này được',
    		'Không thích bài viết này',
    		'Tôi chưa có ý kiến gì',
    		'Fuck quá tệ',
    		'Bitch, bỏ đi'
    	);

    	for($i=1;$i<=100;$i++)
    	{
	        DB::table('comment')->insert(
	        	[
	        		'idUser' => rand(31,40),
	            	'idTopic' => rand(92,136),
	            	'content' => $content[rand(0,11)],
	            	'vote' => rand(1,5),
	            	'created_at' => new DateTime()
	        	]
	    	);
    	}
    }
}
