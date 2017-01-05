<?php

use Illuminate\Database\Seeder;
use App\topic;

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
        $faker = Faker\Factory::create();
        $topic_ids = \App\topic::pluck('id')->toArray();
        $user_ids = \App\user::pluck('id')->toArray();
        $arrayToppic = \App\topic::pluck('vote_count','id');
        $arrayToppicComment = \App\topic::pluck('cmt_count','id');
        $datas = [];
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
        // $arrayToppic = [
        //     '1' => '0',
        //     '2' => '0',
        // ]

    	foreach (range(1, 100) as $key => $value) {
            $idTopic = $faker->randomElement($topic_ids);
            $vote = rand(1,5);
            $datas[] = [
	        		'idUser' => $faker->randomElement($user_ids),
	            	'idTopic' => $idTopic,
	            	'content' => $content[rand(0,11)],
	            	'vote' => $vote,
	            	'created_at' => new DateTime()
	        	];
            $arrayToppic[$idTopic] += $vote;
            $arrayToppicComment[$idTopic] += 1;

    	}
        DB::table('comment')->insert($datas);
        foreach ($arrayToppic as $key => $value) {
            DB::table('topic')->where('id',$key)->update(['vote_count' => $value]);
            DB::table('topic')->where('id',$key)->update(['cmt_count' => $arrayToppicComment[$key]]);
        }
    }
}
