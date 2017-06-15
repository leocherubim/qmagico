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
		// set
		$group = factory(Group::class)->states('admin')->create();

		// expectation
		$result = 'Administrador';

		// assertion
		$this->assertEquals($result, $group->name);
	}

	/**
	 * @test
	 */
	public function create_admin_user()
	{
		// set
		$group = factory(Group::class)->states('admin')->create();
		$user = factory(User::class)->create(['group_id'=>$group->id]);

		// expectation
		$result = 'Administrador';

		// assertion
		$this->assertEquals($result, $user->group->name);
	}

	/**
	 * @test
	 */
	public function show_student_user_list_into_group()
	{
		// set
		$group = factory(Group::class)->states('student')->create();
		$student1 = factory(User::class)->create(['group_id'=>$group->id, 'name'=>'Léo']);
		$student2 = factory(User::class)->create(['group_id'=>$group->id]);

		// expectation
		$resultName = 'Léo';
		$resultCountList = 2;

		// assertion
		$this->assertEquals($resultName, $group->users->first()->name);
		$this->assertCount($resultCountList, $group->users);
	}
}