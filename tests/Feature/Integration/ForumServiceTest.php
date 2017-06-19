<?php

namespace Tests\Feature\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use QMagico\Entities\Group;
use QMagico\Entities\User;
use QMagico\Entities\Forum;
use QMagico\Services\ForumService;

class ForumServiceTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * @User
	 */
	private $admin;

	/**
	 * @ForumService
	 */
	private $forumService;

	public function setUp()
	{
		parent::setUp();

		// register test admin
		$groupAdmin = factory(Group::class)->states('admin')->create();
		$this->admin = factory(User::class)->create(['group_id'=>$groupAdmin->id]);

		// forum model
		$forumModel = $this->app->make(Forum::class);

		$this->forumService = new ForumService($forumModel);
	}

	/**
	 * @test
	 */
	public function save_forum_with_admin_user()
	{
		/*
		 * Set
		 */
		// input data
		$data = ['title'=>'Teste', 'description'=>'Testando'];
		// register forum
		$this->forumService->registerForum($data, $this->admin);

		/*
		 * Expectation
		 */
		$resultForumTitle = 'Teste';
		$forumCount = 1;

		/*
		 * Assertion
		 */
		$this->assertEquals($resultForumTitle, $this->admin->forums->first()->title);
		$this->assertCount($forumCount, $this->admin->forums);
	}

	/**
	 * @test
	 */
	public function update_forum_with_admin_user()
	{
		/*
		 * Set
		 */
		// input data
		$dataInserted = ['title'=>'Teste Inserido', 'description'=>'Testando Inserção'];
		// register forum
		$this->forumService->registerForum($dataInserted, $this->admin);

		$dataUpdated = ['title'=>'Teste Atualizado', 'description'=>'Testando Atualizado'];
		// id forum
		$forumId = $this->admin->forums->first()->id;
		// update forum
		$forumUpdated = $this->forumService->updateForum($dataUpdated, $forumId);

		/*
		 * Expectation
		 */
		$resultForumTitle = 'Teste Atualizado';
		$resultForumDescription = 'Testando Atualizado';

		/*
		 * Assertion
		 */
		$this->assertEquals($resultForumTitle, $forumUpdated->title);
		$this->assertEquals($resultForumDescription, $forumUpdated->description);
	}
}