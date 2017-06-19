<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$adminGroup = factory(\QMagico\Entities\Group::class)->states('admin')->create();

		$admin = factory(\QMagico\Entities\User::class)->create([
			'group_id'=>$adminGroup->id, 'name'=>'Leonardo Cherubini'
		]);

		$forum = factory(\QMagico\Entities\Forum::class)->create([
			'title'=>'Fórum Teste', 'user_id'=>$admin->id
		]);

        factory(\QMagico\Entities\Question::class, 5)->create([
        	'user_id'=>$admin->id,
        	'forum_id'=>$forum->id,
        ]);
    }
}
