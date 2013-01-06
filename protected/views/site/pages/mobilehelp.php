<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Ajuda';
$this->breadcrumbs=array(
	'Ajuda'
);
?>
<div class="row center span_6">
  <img class="center" src="<?php echo Yii::app()->baseUrl?>/images/logo.png">
<h1>Ajuda</h1>
<p>Está com dúvidas sobre o funcionamento ou a usabilidade de nosso site?</p>
<p>Aqui você encontra tudo que precisa saber para tirar o melhor proveito do QuickLic.</p>
<style>
  /* TABS */
.ui-tabs *{
  font-size:13px;
  font-family: 'arial';
  color:#555;
}
.ui-corner-all{
  -moz-border-radius: 0px;
  -webkit-border-radius: 0px;
  -khtml-border-radius: 0px;
  border-radius: 0px;
}
.ui-tabs-nav *{
  -moz-border-radius: 0px;
  -webkit-border-radius: 0px;
  -khtml-border-radius: 0px;
  border-radius: 0px;
}
</style>
<br><br>
<?php $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs'=>array(
        'Como Pesquisar'=>
            '<h3>Como Pesquisar</h3>
              <p>Para efetuar uma pesquisa é muito simples, vá até a página principal do site e digite a palavra na qual deseja buscar no campo de busca (localizado no centro da sua tela). Após isto, clique em "Procurar" e o QuickLic lhe apresentará todos os resultados.</p>
            <p>Caso já esteja em uma página de resultados, você visualizará um campo de busca na parte superior da página, onde é possível efetuar novas buscas por palavras-chaves.</p>',
        'Busca Avançada'=>
            '<h3>Busca Avançada</h3>
              <p>No QuickLic também há a opção de busca avançada. Ela auxilia o usuário a encontrar a licitação procurada, fazendo-o apresentar mais informações para a busca, tais como cidade, estado, etc.</p>
            <p>Para efetuar a busca avançada, clique em "Busca Avançada" no menu superior de qualquer tela e você será direcionado para a página. Nela você pode digitar as informações que desejar e clicar em "Procurar". Logo você visualizará os resultados de sua busca.</p>',
        'Cadastro e Login' => '
            <h3>Cadastro</h3>
            <p>Para você usufruir de todas as funcionalidades do QuickLic, é necessário ter cadastro no nosso site. Para isto, vá em "Cadastre-se" no canto superior direito do website e você será direcionado a página de cadastro. Nela basta digitar todos os dados que são pedidos e clicar em "Ok, Finalize meu Cadastro" ao fim.</p>
            <p>Desta forma você será cadastrado e redirecionado à página principal do QuickLic.</p>

	<h3>Login</h3>
	<p>Ao entrar no site, com o cadastro pré-efetuado, vá até o link de "login", localizado no canto superior direito da página, e você será direcionado à página de login.</p>
	<p>Nela, digite seu usuário e senha e você irá entrar no site.</p>
	<p>Caso você tenha esquecido sua senha, basta ir até o link "esqueci minha senha" e ela lhe enviará sua senha ao email que vc fornecer.</p>
		
	<h3>Vantagens de se cadastrar</h3>
	<p>Uma grande vantagem de se cadastrar é você poder ver todos os dados das licitações que pesquisar, porém não é só isso. O usuário cadastrado consegue ter acesso às buscas avançadas, facilitando sua vida ao pesquisar por licitações em sua região.</p>',
        'FAQ - Top 10' => '
<h3>FAQ - 10 perguntas mais frequentes</h3>          
<h3>Q01: Por que estou vendo "XXX" nas licitações que eu visualizo?</h3>
 <p>R: Pois você não está cadastrado em uma conta para a visualização completa da informação. Caso tenha dúvida para se cadastrar, vá em <link cadastro/login>.</p>

<h3>Q02: Como efetuo o cadastro no site?</h3>
<p>R: Para você usufruir de todas as funcionalidades do QuickLic, é necessário ter cadastro no nosso site. Para isto, vá em "Cadastre-se" no canto superior direito do website e você será direcionado a página de cadastro. Nela basta digitar todos os dados que são pedidos e clicar em "Ok, Finalize meu Cadastro" ao fim.
Desta forma você será cadastrado e redirecionado à página principal do QuickLic.</p>

<h3>Q03: Como efetuo o login no site?</h3>
<p>R: Ao entrar no site, com o cadastro pré-efetuado, vá até o link de "login", localizado no canto superior direito da página, e você será direcionado à página de login.
Nela, digite seu usuário e senha e você irá entrar no site.
Caso você tenha esquecido sua senha, basta ir até o link "esqueci minha senha" e ela lhe enviará sua senha ao email que vc fornecer.</p>

<h3>Q04: Esqueci minha senha, e agora?</h3>
<p>R:Caso você tenha esquecido sua senha, basta ir até o link "esqueci minha senha" na tela de "login" e ele lhe enviará sua senha ao email que vc fornecer.</p>

<h3>Q05: Quais as vantagens de eu me cadastrar no site?</h3>
<p>R: Uma grande vantagem de se cadastrar é você poder ver todos os dados das licitações que pesquisar, porém não é só isso. O usuário cadastrado consegue ter acesso às buscas avançadas, facilitando sua vida ao pesquisar por licitações em sua região.</p>

<h3>Q06: Por que eu não encontro as licitações da minha cidade?</h3>
<p>R: Caso você esteja cadastrado, pode ser que sua cidade ainda não esteja cadastrada no QuickLic. Se isso ocorrer, entre em contato conosco para resolvermos isto para você o mais rápido possível.</p>

<h3>Q07: Como eu faço uma pesquisa no site?</h3>
<p>R: Para efetuar uma pesquisa é muito simples, vá até a página principal do site e digite a palavra na qual deseja buscar no campo de busca (localizado no centro da sua tela). Após isto, clique em "Procurar" e o QuickLic lhe apresentará todos os resultados.
Caso já esteja em uma página de resultados, você visualizará um campo de busca na parte superior da página, onde é possível efetuar novas buscas por palavras-chaves.</p>

<h3>Q08: Como fazer uma pesquisa avançada no site?</h3>
<p>R:No QuickLic também há a opção de busca avançada. Ela auxilia o usuário a encontrar a licitação procurada, fazendo-o apresentar mais informações para a busca, tais como cidade, estado, etc.
Para efetuar a busca avançada, clique em "Busca Avançada" no menu superior de qualquer tela e você será direcionado para a página. Nela você pode digitar as informações que desejar e clicar em "Procurar". Logo você visualizará os resultados de sua busca.</p>

<h3>Q09: Gostaria de informar um erro no site, como fazer?</h3>
<p>R: Para fazer isto basta clicar em "contate-nos" no menu superior da página e nos enviar uma mensagem.</p>

<h3>Q10: Gostaria de saber como funciona o site de voces.</h3>
<p>R: Vá em "Sobre Nós" no menu superior do site e leia um pouco sobre o site e seu funcionamento.</p>'
        ),
)); ?>
</div>