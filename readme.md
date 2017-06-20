## Avaliação QMágico

<p>
	Este projeto consiste na avaliação do processo seletivo do QMágico. <br>
	Para o desenvolvimento do Sistema de fórum de mensagens foi utilizado <br>
	o framework PHP Laravel em sua versão 5.3 e para a troca de mensagens <br>
	baseadas em AJAX, o framework Angular em suar verão 1.3 foi adotado.
</p>

<p>
	A aplicação se encontrar hospedada no Heroku no segunte link: <br>
	<a href="http://warm-citadel-15302.herokuapp.com/login">Avaliação QMágico</a>
	<br>
	http://warm-citadel-15302.herokuapp.com/login

</p>

<p>
	O framework PHP utilizado provê toda uma estrutura fullstack de desenvolvimento. <br>
	Para o funcionamento da aplicação, são necessários as seguintes dependências:
	<ul>
		<li>PHP 5.6.4 ou superior</li>
		<li>Gerenciador de dependências Composer</li>
		<li>Gerenciador de dependências npm</li>
		<li>E o gerenciador de front-end bower</li>
	</ul>

	Com esses 4 programas configurados, o aplicativo pode rodar sem nenhum dificuldade.
</p>

### Instalação do projeto

<p>
	Primeiramente é necessário a instalação ou download do PHP 5.6.4 ou superior. De preferência, baixar as versões 
	mais atuais do <a href="http://php.net/downloads.php">PHP</a>. Com está versão <br>
	instalada, o composer já pode ser baixado pelo seu arquivo composer.phar ou instalado através do executável. <br>
	Para mais informações consultar o site oficial do <a href="https://getcomposer.org/download/">Composer</a>.
</p>

<p>
	Após a instalação do php e composer, já poderemos começar a levantar a aplicação. A partir da versão 5.4 do PHP, <br>
	foi lançado um servidor embutido, que para este projeto será mais do que necessário para levantar a aplicação.
</p>

### Após o clone do projeto, siga na pasta raiz e execute o seguinte comando:

```
composer install
```

<p>
	Este comando é responsável por empacotar e modularizar todas as dependências do Projeto Laravel. Com as dependências <br>
	baixadas, o próximo passo será rodar o servidor embutido com o seguinte comando do Laravel.
</p>

```
php artisan serve
```

<p>
	Deste modo, a aplicação será executada na porta 8000, e da maneira que está configurada no projeto, a página web será redirecionada <br>
	para a página de login. A seguir, serão abordados como configurar o banco de dados e exemplificados um pouco sobre a arquitetura de <br>
	pastas do projeto, principalmente nas pastas onde estão a régra de negócio e os códigos de teste.
</p>

