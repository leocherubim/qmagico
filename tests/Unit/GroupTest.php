<?php

namespace Tests\Unit;

use Tests\TestCase;
use QMagico\Entities\Group;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use QMagico\Entities\User;

class GroupTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * @test
	 */
	public function create_simple_group()
	{
		/*
		 * Set
		 */
		$group = factory(Group::class)->states('admin')->create();

		/*
		 * Expectation
		 */
		$result = 'Administrador';

		/*
		 * Assertion
		 */
		$this->assertEquals($result, $group->name);
	}

	/**
	 * @test
	 */
	public function create_admin_user()
	{
		/*
		 * Set
		 */
		$group = factory(Group::class)->states('admin')->create();
		$user = factory(User::class)->create(['group_id'=>$group->id]);

		/*
		 * Expectation
		 */
		$result = 'Administrador';

		/*
		 * Assertion
		 */
		$this->assertEquals($result, $user->group->name);
	}

	/**
	 * @test
	 */
	public function show_student_user_list_into_group()
	{
		/*
		 * Set
		 */
		$group = factory(Group::class)->states('student')->create();
		$student1 = factory(User::class)->create(['group_id'=>$group->id, 'name'=>'Léo']);
		$student2 = factory(User::class)->create(['group_id'=>$group->id]);

		/*
		 * Expectation
		 */
		$resultName = 'Léo';
		$resultCountList = 2;

		/*
		 * Assertion
		 */
		$this->assertEquals($resultName, $group->users->first()->name);
		$this->assertCount($resultCountList, $group->users);
	}
}