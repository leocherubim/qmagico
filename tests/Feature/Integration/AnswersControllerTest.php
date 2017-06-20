<?php

namespace Tests\Feature\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use QMagico\Entities\Group;
use QMagico\Entities\User;
use QMagico\Entities\Forum;
use QMagico\Entities\Question;
use QMagico\Entities\Answer;

class AnswersControllerTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * @User
	 */
	private $student;

	/**
	 * @Forum
	 */
	private $question;

	public function setUp()
	{
		parent::setUp();

		// create Admin User
		$adminGroup = factory(Group::class)->states('admin')->create();
		$admin = factory(User::class)->create(['group_id'=>$adminGroup->id, 'name'=>'Leonardo Cherubini']);

		$studentGroup = factory(Group::class)->states('student')->create();
		$this->student = factory(User::class)->create(['group_id'=>$studentGroup->id, 'name'=>'Léo']);

		$forum = factory(Forum::class)->create(['title'=>'Fórum Teste', 'user_id'=>$admin->id]);

		$this->question = factory(Question::class)->create([
			'forum_id'=>$forum->id, 
			'user_id'=>$admin->id, 
			'title'=>'Questão Teste'
		]);
	}

	/**
	 * @test
	 */
	public function fetches_all_answer()
	{
		/*
		 * Set
		 */
		// logged Admin
		$this->be($this->student);
		// Questions list
		$answer = factory(Answer::class)->create([
			'title'=>'Resposta', 
			'question_id' => $this->question->id,
			'user_id' =>$this->student->id
		]);		

		/*
		 * Expectation
		 */
		$this->visit('api/answer/'.$this->question->id);

		/*
		 * Assertion
		 */
		$this->seeJson([
			'title'=>$answer->title
		]);
	}

	/**
	 * @test
	 */
	public function fetches_all_answer_without_parent()
	{
		/*
		 * Set
		 */
		// logged Admin
		$this->be($this->student);
		// Questions list
		$answerParent = factory(Answer::class)->create([
			'title'=>'Parent 1', 
			'question_id' => $this->question->id,
			'user_id' =>$this->student->id
		]);

		$answerChild1 = factory(Answer::class)->create([
			'title'=>'Child1', 
			'question_id' => $this->question->id,
			'user_id' =>$this->student->id,
			'parent_id'=>$answerParent->id
		]);

		$answerChild2 = factory(Answer::class)->create([
			'title'=>'Child2', 
			'question_id' => $this->question->id,
			'user_id' =>$this->student->id,
			'parent_id'=>$answerParent->id
		]);		

		/*
		 * Expectation
		 */
		$this->visit('api/answer/'.$this->question->id);

		/*
		 * Assertion
		 */
		$this->seeJson([
			'title'=>$answerParent->title
		]);
		$this->dontSeeJson([
			'title'=>'Child1',
			'title'=>'Child2'
		]);
	}

	/**
	 * @test
	 */
	public function create_answer()
	{
		/*
		 * Set
		 */
		// logged Admin
		$this->be($this->student);
		// data to persiste
		$data = ['user_id'=>$this->student->id, 'question_id'=>$this->question->id, 'title'=>'Resposta'];

		// execute POST
		$this->post('api/answer', $data);

		/*
		 * Expectation
		 */
		$resultAnswerTitle = 'Resposta';

		/*
		 * Assertion
		 */
		$this->assertCount(1, $this->question->answers);
		$this->assertEquals($resultAnswerTitle, $this->question->answers->first()->title);
	}

	// /**
	//  * @test
	//  */
	// public function update_question()
	// {
	// 	/*
	// 	 * Set
	// 	 */
	// 	// logged Admin
	// 	$this->be($this->admin);
	// 	// data to persiste
	// 	$question = factory(Question::class)->create([
	// 		'user_id'=>$this->admin->id, 
	// 		'forum_id'=>$this->forum->id, 
	// 		'title'=>'teste'
	// 	]);

	// 	// input question
	// 	$data = [
	// 		'id'=>$question->id,
	// 		'user_id'=>$question->user_id,
	// 		'forum_id'=>$question->forum_id,
	// 		'title'=>'teste atualizado',
	// 	];

	// 	// execute PUT
	// 	$this->put('api/question/'.$question->id, $data);

	// 	/*
	// 	 * Expectation
	// 	 */
	// 	$resultQuestionTitle = 'teste atualizado';

	// 	/*
	// 	 * Assertion
	// 	 */
	// 	$this->assertEquals($resultQuestionTitle, $this->forum->questions->first()->title);
	// }

	// /**
	//  * @test
	//  */
	// public function delete_question()
	// {
	// 	/*
	// 	 * Set
	// 	 */
	// 	// logged Admin
	// 	$this->be($this->admin);
	// 	// data to persiste
	// 	$question = factory(Question::class)->create([
	// 		'user_id'=>$this->admin->id, 
	// 		'forum_id'=>$this->forum->id, 
	// 		'title'=>'teste'
	// 	]);

	// 	// execute DELETE
	// 	$this->delete('api/question/'.$question->id);

	// 	/*
	// 	 * Expectation
	// 	 */
	// 	$resultQuestionsCount = 0;
	// 	$resultQuestionNotExists = Question::find($question->id);
		
	// 	/*
	// 	 * Assertion
	// 	 */
	// 	$this->assertCount($resultQuestionsCount, $this->forum->questions);
	// 	$this->assertNull($resultQuestionNotExists);
	// }

}