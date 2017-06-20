<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
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

		$studentGroup = factory(\QMagico\Entities\Group::class)->states('student')->create();

		$student = factory(\QMagico\Entities\User::class)->create([
			'group_id'=>$studentGroup->id, 'name'=>'Leonardo Cherubini'
		]);

		$forum = factory(\QMagico\Entities\Forum::class)->create([
			'title'=>'Fórum Teste', 'user_id'=>$admin->id
		]);

        $question = factory(\QMagico\Entities\Question::class)->create([
        	'user_id'=>$admin->id,
        	'forum_id'=>$forum->id,
        ]);

        factory(\QMagico\Entities\Answer::class, 5)->create([
        	'user_id'=>$student->id,
        	'question_id'=>$question->id
        ]);

    }
}
