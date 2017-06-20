<?php

namespace Tests\Feature\Acceptance;

use Tests\TestCase;
use QMagico\Entities\Forum;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use QMagico\Entities\User;
use QMagico\Entities\Group;
use QMagico\Entities\Question;

class AccessForumTest extends TestCase
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
		/*
		 * Set
		 */
		// creating forums
		$forumAsk = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		$forumExplain = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		// logged Admin
		$this->be($this->admin);
		// forums link
		$forumsLink = route('forum.index');

		/*
		 * Expectation
		 */
		$this->visit('home');
		$this->seeLink('Fóruns', $forumsLink);
		$this->get($forumsLink);

		/*
		 * Assertion
		 */
		$this->see($forumAsk->title);
		$this->see($forumExplain->title);
	}

	/**
	 * @test
	 */
	public function student_cannot_access_forum_page()
	{
		/*
		 * Set
		 */
		// logged Student
		$this->be($this->student);
		// forums link
		$forumsLink = route('forum.index');

		/*
		 * Expectation
		 */
		$this->visit('home');
		
		/*
		 * Assertion
		 */
		$this->dontSeeLink('Fóruns', $forumsLink);
	}

	/**
	 * @test
	 */
	public function student_cannot_access_forum_routes()
	{
		/*
		 * Set
		 */
		// logged Student
		$this->be($this->student);
		// forums link
		$forumsLink = route('forum.index');

		/*
		 * Expectation
		 */
		$this->get($forumsLink);

		/*
		 * Assertion
		 */
		$this->assertRedirectedTo('home');
	}

	/**
	 * @test
	 */
	public function student_see_forum_list()
	{
		/*
		 * Set
		 */
		// creating forums
		$forumAsk = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		$forumExplain = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		// logged Student
		$this->be($this->student);

		/*
		 * Expectation
		 */
		$this->visit('home');
		
		/*
		 * Assertion
		 */
		$this->see($forumAsk->name);
		$this->see($forumExplain->name);

	}

	/**
	 * @test
	 */
	public function display_forum_list_with_questions_count()
	{
		/*
		 * Set
		 */
		// creating forums
		$forumAsk = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		$forumExplain = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		// creating questions
		$question1 = factory(Question::class)->create([
			'forum_id' => $forumExplain->id,
			'user_id' => $this->admin->id
		]);
		$question2 = factory(Question::class)->create([
			'forum_id' => $forumExplain->id,
			'user_id' => $this->admin->id
		]);

		// logged Student
		$this->be($this->student);

		/*
		 * Expectation
		 */
		$this->visit('home');

		/*
		 * Assertion
		 */
		$this->see('<span class="badge badge-inverse">0</span>');
		$this->see('<span class="badge badge-inverse">2</span>');
	}

	/**
	 * @test
	 */
	public function display_forum_view()
	{
		/*
		 * Set
		 */
		$forumAsk = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		// logged Student
		$this->be($this->student);
		// Show Forum Route
		$routeForumShow = route('forum.show', ['id'=>$forumAsk->id]);

		/*
		 * Expectation
		 */
		$this->visit('home');
		$this->get($routeForumShow);

		/*
		 * Assertion
		 */
		$this->seePageIs($routeForumShow);
		$this->see($forumAsk->title);
		$this->see($forumAsk->description);
	}

}