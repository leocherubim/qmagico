<?php

namespace Tests\Feature\Acceptance;

use Tests\TestCase;
use QMagico\Entities\Forum;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use QMagico\Entities\User;
use QMagico\Entities\Group;

class ForumCrudTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * @User
	 */
	private $admin;

	public function setUp()
	{
		parent::setUp();

		// Create Groups
		$adminGroup = factory(Group::class)->states('admin')->create();

		// Admin User
		$this->admin = factory(User::class)->create(['name'=>'Administrador', 'group_id'=>$adminGroup->id]);

		// logged Admin
		$this->be($this->admin);
	}

	/**
	 * @test
	 */
	public function display_register_forum_view()
	{
		/*
		 * Set
		 */
		// forums routes
		$routeForumCreate = route('forum.create');
		$routeForumIndex = route('forum.index');

		/*
		 * Expectation
		 */
		$this->visit($routeForumIndex);
		$this->seeLink('Cadastrar', $routeForumCreate);
		$this->get($routeForumCreate);

		/*
		 * Assertion
		 */
		$this->seePageIs($routeForumCreate);
		$this->see('Cadastrar Fórum');
	}

	/**
	 * @test
	 */
	public function register_forum_and_redirect_to_index_forum_view()
	{
		/*
		 * Set
		 */
		// forums routes
		$routeForumCreate = route('forum.create');
		$routeForumIndex = route('forum.index');

		/*
		 * Expectation
		 */
		$this->visit($routeForumCreate);
		$this->type('Fórum Teste', 'title');
		$this->type('Descrevendo o assunto', 'description');
		$this->press('Cadastrar');

		/*
		 * Assertion
		 */
		$this->seePageIs($routeForumIndex);
		$this->see('Fórum Teste');
		$this->see($this->admin->name);
	}

	/**
	 * @test
	 */
	public function error_in_register_forum()
	{
		/*
		 * Set
		 */
		// forums routes
		$routeForumCreate = route('forum.create');

		/*
		 * Expectation
		 */
		$this->visit($routeForumCreate);
		$this->type('', 'title');
		$this->type('', 'description');
		$this->press('Cadastrar');

		/*
		 * Assertion
		 */
		$this->seePageIs($routeForumCreate);
		$this->see('O campo título é obrigatório.');
		$this->see('O campo descrição é obrigatório.');
	}

	/**
	 * @test
	 */
	public function display_forum_edit_view()
	{
		/*
		 * Set
		 */
		$forum = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		$routeIndexForum = route('forum.index');
		$routeEditForum = route('forum.edit', ['id'=>$forum->id]);

		/*
		 * Expectation
		 */
		$this->visit($routeIndexForum);
		// Edit Forum Button
		$this->seeLink('Editar', $routeEditForum);
		// Press Edit Button
		$this->get($routeEditForum);

		/*
		 * Assertion
		 */
		$this->seePageIs($routeEditForum);
		$this->see($forum->title);
	}

	/**
	 * @test
	 */
	public function update_forum_and_redirect_to_index_view()
	{
		/*
		 * Set
		 */
		$forum = factory(Forum::class)->create(['user_id'=>$this->admin->id]);
		$routeEditForum = route('forum.edit', ['id'=>$forum->id]);
		$routeIndexForum = route('forum.index');

		/*
		 * Expectation
		 */
		$this->visit($routeEditForum);
		$this->type('Teste Atualizado', 'title');
		$this->type('Descrição Atualizada', 'description');
		$this->press('Editar');

		/*
		 * Assertion
		 */
		$this->seePageIs($routeIndexForum);
		$this->see('Teste Atualizado');
	}

	/**
	 * @test
	 */
	public function delete_forum_and_redirect_to_index()
	{
		/*
		 * Set
		 */
		$forum = factory(Forum::class)->create(['user_id'=>$this->admin->id, 'title'=>'Teste Title']);
		$routeIndexForum = route('forum.index');
		$routeDeleteForum = route('forum.destroy', ['id'=>$forum->id]);

		/*
		 * Expectation
		 */
		$this->visit($routeIndexForum);
		$this->see('Teste Title');
		$this->seeLink('Deletar', $routeDeleteForum);
		// press Delete Button
		$this->get($routeDeleteForum);

		/*
		 * Assertion
		 */
		$this->assertRedirectedTo($routeIndexForum);
		$this->dontSee('Teste Title');
	}
}