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

### Configuração de Banco de dados

<p>
	A configuração de banco de dados está presente no seguinte caminho: config/database.php. <br>
	Neste arquivo pode ser escolhido qual o SGBD de preferência. Após a escolha do banco de dados e <br>
	do resgistro das respectivas credenciais, o próximo passo será apresentar a estruturas de pastas <br>
	responsáveis por trabalhar com a persistência de dados no Laravel. Na pasa database estão todos as <br>
	arquivos responsáveis por criar tabelas, gerenciá-las, testas estruturas e demais funcionalidades. Existe 
	uma pasta chamada seed onde será usado apenas um arquivo para a criação das categorias dos usuários. Em 
	relação ao banco de dados em geral, a única pasta de real 	importância para está documentação é a migrations. 
	Pois é nela que temos declarados as tabelas usadas na aplicação. As tabelas criadas para a presente aplicação <br>
	estão listadas logo abaixo:
</p>

<ul>
	<li>groups</li>
	<li>users</li>
	<li>forums</li>
	<li>questions</li>
	<li>answers</li>
</ul>

### Criando as tabelas no banco de dados

<p>Execute o comando a seguir:</p>

```
php artisan migration --seed
```

<p>
	O comando artisan migration são responsáveis por criar as tabelas e o --seed apenas automatiza
	a criação dos dois grupos de usuários solicitados para poder dar sequência as soliciações feitas na aplicação.
</p>

<p>
	Todas as dependências necessários para o funcionamento correto da aplicação já foram atendidas. Agora o sistema
	está pronto para a avaliação.
</p>

<p>
	A estrutura de pastas do Laravel pode paracer um pouco confusa no começo, mas  para este tutorial, as únicas pastas <br>
	que importam são app/, resources/ e tests/. Existe também a pasta route/ onde as rotas foram mapeadas.
</p>

<ul>
	<li>app - é neste diretório onde encontram-se todos os arquivos de regra de negócio</li>
	<li>resources - está pasta possui todos os arquivos de visualização da aplicação</li>
	<li>tests - para está avaliação, foi feita a quebra dos teste em aceitação, integração e unitários</li>
</ul>

### Resources

<p>
	A pastas resources possui os arquivos less, css, js e o template engine Blade. Como o objetivo
	de maximizar a performace da aplicação, foi adotado o sistema de minificação de arquivos css e
	JavaScript utilizando o automatizador de tarefas GULP. Segue a baixo a estrutura de pastas.
</p>

```
assets/
lang/
views/
```

<p>
	O ponta mais importante a ser abordade em resource foi a localização dos arquivos do Angular. Estes estão presentes em assets/js/app.
</p>

## Padrões de codificações

<p>
	Como padrão de desenvolvimento, em todo o desenvolvimento foi utlizada TDD. Primeiramente, a organização das views deram origem aos <br>testes de aceitação. Após a criação das entidades foram surgindo os testes de unidade. Por fim, foram criados alguns testes de aceitação <br> e integração para complementar a contrução da API.
</p>

<p>
	Na pasta app/Http/ estão os controles da aplicação e da API responsáveis pelos questionários e <br> responstas. Na pasta app/Entities/ estão as entidades do banco. Durante o desenvolvimento <br> do Angular foram criados dois controles e um serviço.
</p>

<p>
	Por fim, este projeto utilizou as convenções de programação recomendadas pela comunidade Laravel. Todo o processo de desenvolvimento foi <br>baseado no TDD. É utilizado o sistema de autenticação simples do Laravel e por fim, foi criado uma pequena API para a criação de <br>perguntas. Como medida de segurança, o Angular, não deixa os usuários acessarem os botões para a manipulação das perguntas de outros <br>
	usuários. E o Laravel mantem o back-end protegido dos usuários que tentarem efetuar requisições a componentes de outros usuários.

</p>




