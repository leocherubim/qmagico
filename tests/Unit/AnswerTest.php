<?php

namespace Tests\Unit;

use Tests\TestCase;
use QMagico\Entities\User;
use QMagico\Entities\Group;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use QMagico\Entities\Forum;
use QMagico\Entities\Question;
use QMagico\Entities\Answer;

class AnswerTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * @User
	 */
	private $student;

	/**
	 * @Question
	 */
	private $question;

	public function setUp()
	{
		parent::setUp();

		// create Admin User
		$adminGroup = factory(Group::class)->states('admin')->create();
		$this->admin = factory(User::class)->create(['group_id'=>$adminGroup->id, 'name'=>'Leonardo Cherubini']);

		$studentGroup = factory(Group::class)->states('student')->create();
		$this->student = factory(User::class)->create(['group_id'=>$studentGroup->id, 'name'=>'Léo']);

		$this->forum = factory(Forum::class)->create(['title'=>'Fórum Teste', 'user_id'=>$this->admin->id]);

		$this->question = factory(Question::class)->create([
			'forum_id'=>$this->forum->id, 
			'user_id'=>$this->admin->id, 
			'title'=>'Questão Teste'
		]);

	}

	/**
	 * @test
	 */
	public function create_simple_answer()
	{
		/*
		 * Set
		 */
		$answer = factory(Answer::class)->create([
			'title'=>'Resposta', 
			'question_id' => $this->question->id,
			'user_id' =>$this->student->id
		]);

		/*
		 * Expectation
		 */
		$resultAnswerTitle = 'Resposta';
		$resultQuestionTitle = 'Questão Teste';
		$resultStudentName = 'Léo';

		/*
		 * Assertion
		 */
		$this->assertEquals($resultAnswerTitle, $answer->title);
		$this->assertEquals($resultAnswerTitle, $this->question->answers->first()->title);
		$this->assertEquals($resultAnswerTitle, $this->student->answers->first()->title);
		$this->assertEquals($resultQuestionTitle, $answer->question->title);
		$this->assertEquals($resultStudentName, $answer->user->name);
		$this->assertCount(1, $this->question->answers);
		$this->assertCount(1, $this->student->answers);
		$this->assertNull($answer->parent);
		$this->assertCount(0, $answer->children);
	}

	/**
	 * @test
	 */
	public function create_answer_with_parent()
	{
		/*
		 * Set
		 */
		$answerParent = factory(Answer::class)->create([
			'title'=>'Pai', 
			'question_id' => $this->question->id,
			'user_id' =>$this->student->id
		]);

		$answerChild = factory(Answer::class)->create([
			'title'=>'Filho', 
			'question_id' => $this->question->id,
			'user_id' =>$this->student->id,
			'parent_id' => $answerParent->id
		]);

		/*
		 * Expectation
		 */
		$resultParentName = 'Pai';

		/*
		 * Assertion
		 */
		$this->assertEquals($resultParentName, $answerChild->parent->title);
	}

	/**
	 * @test
	 */
	public function create_two_answer_into_parent_answer()
	{
		/*
		 * Set
		 */
		$answerParent = factory(Answer::class)->create([
			'title'=>'Pai', 
			'question_id' => $this->question->id,
			'user_id' =>$this->student->id
		]);

		$answerChild = factory(Answer::class)->create([
			'title'=>'Filho', 
			'question_id' => $this->question->id,
			'user_id' =>$this->student->id,
			'parent_id' => $answerParent->id
		]);

		$answerChild2 = factory(Answer::class)->create([
			'title'=>'Segundo Filho',
			'question_id' => $this->question->id,
			'user_id' =>$this->student->id,
			'parent_id' => $answerParent->id
		]);

		/*
		 * Expectation
		 */
		$resultChildrenCount = 2;
		$resultChildTitle = 'Filho';

		/*
		 * Assertion
		 */
		$this->assertCount($resultChildrenCount, $answerParent->children);
		$this->assertEquals($resultChildTitle, $answerParent->children->first()->title);
	}
}