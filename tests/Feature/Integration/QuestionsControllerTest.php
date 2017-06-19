<?php

namespace Tests\Feature\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use QMagico\Entities\Group;
use QMagico\Entities\User;
use QMagico\Entities\Forum;
use QMagico\Entities\Question;

class QuestionsControllerTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * @User
	 */
	private $admin;

	/**
	 * @Forum
	 */
	private $forum;

	public function setUp()
	{
		parent::setUp();

		// Create Groups
		$adminGroup = factory(Group::class)->states('admin')->create();

		// Admin User
		$this->admin = factory(User::class)->create(['name'=>'Administrador', 'group_id'=>$adminGroup->id]);

		$this->forum = factory(Forum::class)->create(['title'=>'Fórum Teste', 'user_id'=>$this->admin->id]);
	}

	/**
	 * @test
	 */
	public function fetches_all_question()
	{
		/*
		 * Set
		 */
		// logged Admin
		$this->be($this->admin);
		// Questions list
		$question = factory(Question::class)->create(['user_id'=>$this->admin->id, 'forum_id'=>$this->forum->id, 'title'=>'teste']);		

		/*
		 * Expectation
		 */
		$this->visit('api/question');

		/*
		 * Assertion
		 */
		$this->seeJson([
			'title'=>$question->title
		]);
	}

	/**
	 * @test
	 */
	public function create_question()
	{
		/*
		 * Set
		 */
		// logged Admin
		$this->be($this->admin);
		// data to persiste
		$data = ['user_id'=>$this->admin->id, 'forum_id'=>$this->forum->id, 'title'=>'teste'];
		// execute POST
		$this->post('api/question', $data);

		/*
		 * Expectation
		 */
		$resultQuestionTitle = 'teste';

		/*
		 * Assertion
		 */
		$this->assertCount(1, $this->forum->questions);
		$this->assertEquals($resultQuestionTitle, $this->forum->questions->first()->title);
	}

	/**
	 * @test
	 */
	public function update_question()
	{
		/*
		 * Set
		 */
		// logged Admin
		$this->be($this->admin);
		// data to persiste
		$question = factory(Question::class)->create([
			'user_id'=>$this->admin->id, 
			'forum_id'=>$this->forum->id, 
			'title'=>'teste'
		]);

		// input question
		$data = [
			'id'=>$question->id,
			'user_id'=>$question->user_id,
			'forum_id'=>$question->forum_id,
			'title'=>'teste atualizado',
		];

		// execute PUT
		$this->put('api/question/'.$question->id, $data);

		/*
		 * Expectation
		 */
		$resultQuestionTitle = 'teste atualizado';

		/*
		 * Assertion
		 */
		$this->assertEquals($resultQuestionTitle, $this->forum->questions->first()->title);
	}

	/**
	 * @test
	 */
	public function delete_question()
	{
		/*
		 * Set
		 */
		// logged Admin
		$this->be($this->admin);
		// data to persiste
		$question = factory(Question::class)->create([
			'user_id'=>$this->admin->id, 
			'forum_id'=>$this->forum->id, 
			'title'=>'teste'
		]);

		// execute DELETE
		$this->delete('api/question/'.$question->id);

		/*
		 * Expectation
		 */
		$resultQuestionsCount = 0;
		$resultQuestionNotExists = Question::find($question->id);
		
		/*
		 * Assertion
		 */
		$this->assertCount($resultQuestionsCount, $this->forum->questions);
		$this->assertNull($resultQuestionNotExists);
	}

}