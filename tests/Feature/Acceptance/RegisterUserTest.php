<?php

namespace Tests\Feature\Acceptance;

use Tests\TestCase;

class ResgisterUserTest extends TestCase
{
	/**
	 * @test
	 */
	public function error_in_the_register_user_without_group()
	{
		/*
		 * Set
		 */
		$this->visit('register');

		/*
		 * Expectation
		 */
		$this->type('Leonardo Cherubini', 'name');
		$this->type('cherubini18@gmail.com', 'email');
		$this->type('123456', 'password');
		$this->type('123456', 'password_confirmation');
		$this->press('Registrar');

		/*
		 * Assertion
		 */
		$this->see('O campo grupo é obrigatório.');
	}
}