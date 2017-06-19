<?php

namespace Tests\Unit;

use Tests\TestCase;
use QMagico\Entities\User;
use QMagico\Entities\Group;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use QMagico\Entities\Forum;
use QMagico\Entities\Question;

class QuestionTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * @User
	 */
	private $admin;

	/**
	 * @User
	 */
	private $student;

	/**
	 * @Forum
	 */
	private $forum;

	public function setUp()
	{
		parent::setUp();

		// create Admin User
		$adminGroup = factory(Group::class)->states('admin')->create();
		$this->admin = factory(User::class)->create(['group_id'=>$adminGroup->id, 'name'=>'Leonardo Cherubini']);

		$studentGroup = factory(Group::class)->states('student')->create();
		$this->student = factory(User::class)->create(['group_id'=>$studentGroup->id, 'name'=>'Léo']);

		$this->forum = factory(Forum::class)->create(['title'=>'Fórum Teste', 'user_id'=>$this->admin->id]);
	}

	/**
	 * @test
	 */
	public function create_simple_question()
	{
		/*
		 * Set
		 */
		$question = factory(Question::class)->create(['forum_id'=>$this->forum->id, 'user_id'=>$this->admin->id, 'title'=>'Questão Teste']);

		/*
		 * Expectation
		 */
		$resultQuestionTitle = 'Questão Teste';
		$resultForumTitle = 'Fórum Teste';
		$resultUserName = 'Leonardo Cherubini';

		/*
		 * Assertion
		 */
		$this->assertEquals($resultQuestionTitle, $question->title);
		$this->assertEquals($resultQuestionTitle, $this->forum->questions->first()->title);
		$this->assertEquals($resultForumTitle, $question->forum->title);
		$this->assertEquals($resultUserName, $question->user->name);
		$this->assertCount(1, $this->forum->questions);
	}
}