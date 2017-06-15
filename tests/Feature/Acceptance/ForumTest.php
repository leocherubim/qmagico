<?php

namespace Tests\Feature\Acceptance;

use Tests\TestCase;
use QMagico\Entities\Forum;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use QMagico\Entities\User;
use QMagico\Entities\Group;

class ForumTest extends TestCase
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

	public function setUp()
	{
		parent::setUp();

		// Create Groups
		$adminGroup = factory(Group::class)->states('admin')->create();
		$studentGroup = factory(Group::class)->states('student')->create();

		// Admin User
		$this->admin = factory(User::class)->create(['name'=>'Administrador', 'group_id'=>$adminGroup->id]);
		// Student User
		$this->student = factory(User::class)->create(['name'=>'Administrador', 'group_id'=>$studentGroup->id]);
	}

	/**
	 * @test
	 */
	public function admin_can_access_forum_page()
	{
		// set
		// creating forums
		$forumAsk = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		$forumExplain = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		// logged Admin
		$this->be($this->admin);
		// forums link
		$forumsLink = route('forum.index');

		// expectation
		$this->visit('home');
		$this->seeLink('Fóruns', $forumsLink);
		$this->get($forumsLink);

		// assertion
		$this->see($forumAsk->title);
		$this->see($forumExplain->title);
	}
}