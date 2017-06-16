<?php

namespace Tests\Unit;

use Tests\TestCase;
use QMagico\Entities\User;
use QMagico\Entities\Group;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use QMagico\Entities\Forum;

class ForumTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * @User
	 */
	private $admin;

	public function setUp()
	{
		parent::setUp();

		// create Admin User
		$adminGroup = factory(Group::class)->states('admin')->create();
		$this->admin = factory(User::class)->create(['group_id'=>$adminGroup->id, 'name'=>'Léo']);
	}

	/**
	 * @test
	 */
	public function create_simple_forum()
	{
		/*
		 * Set
		 */
		$forum = factory(Forum::class)->create(['title'=>'teste', 'user_id'=>$this->admin->id]);

		/*
		 * Expectation
		 */
		$resultName = 'teste';
		$resultUserName = 'Léo';

		/*
		 * Assertion
		 */
		$this->assertEquals($resultName, $forum->title);
		$this->assertEquals($resultName, $this->admin->forums->first()->title);
		$this->assertEquals($resultUserName, $forum->user->name);
		$this->assertCount(1, $this->admin->forums);
	}
}