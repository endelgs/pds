<?php /* @var $this Controller */ 
//echo $_SERVER['HTTP_USER_AGENT'];die();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>	
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/responsive.gs.12col/reset.css" media="screen, projection,handheld" />
        
	<!-- blueprint CSS framework -->
	<!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" / -->
	<!--[if lt IE 8]>
        
          <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/responsive.gs.12col/reset.css" media="screen, projection" />	
          <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        
	<![endif]-->
      <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/responsive.gs.12col/responsive-gs-12col.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/quicklic.css" media="screen"/>
        <!-- link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mobile.css" media="screen"/ -->
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        
</head>

<body>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=282677875161941";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="container" id="page">

	<!-- div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu" class="row">
          
		<?php 
                $searchButton = (Yii::app()->getController() instanceof SiteController)?
                  array('/site/index'): array('/licitacoes/search');
                $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label' => 'Pesquisa', 'url' => $searchButton),
                                array('label' => 'Busca Avançada', 'url' => array('/licitacoes/buscaAvancada')),
				array('label' => 'Sobre nós', 'url'=>array('/site/page', 'view'=>'about')),
                                array('label' => 'Ajuda', 'url'=>array('/site/page', 'view'=>'help')),
                                array('label' => 'Contato', 'url'=>array('/site/contact')),
			),
                        'htmlOptions' => array('class'=> 'col span_8'),
		)); ?>
          <ul class="col span_4" style='float:right;margin-right:10px; color:#fff;font-weight:bold;'>
            <li>
          <?php
          // Exibindo o nome do usuario no canto direito
          if(Yii::app()->user->isGuest){
            
            echo "Olá Visitante </li><li>".CHtml::link('Login',array('/site/login'))."</li><li> ".CHtml::link('Cadastre-se',array('/usuarios/create'),array('class'=>'highlight'));
          }else{
            $u = Usuarios::model()->findByPk(Yii::app()->user->id);
            $nome = (strlen($u->nome) > 0)?$u->nome:$u->nome_usuario;
            echo CHtml::link("Olá ".$nome,array('usuarios/update'),array('style'=>'text-decoration:underline'))." </li><li> ".CHtml::link('Logoff',array('site/logout'));
          }
          ?>
            </li>
          </ul>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<!-- div id="footer" class="col span_12">
		Copyright &copy; <?php echo date('Y'); ?> by IHC & PDS Company.<br/>
		<?php echo Yii::powered(); ?> and PHP
	</div><!-- footer -->
                <div id="footers">
                  <?php $this->widget('application.extensions.social.social', array(
    'style'=>'horizontal', 
        'networks' => array(
        'twitter'=>array(
            'data-via'=>'', //http://twitter.com/#!/YourPageAccount if exists else leave empty
            ), 
        'googleplusone'=>array(
            "size"=>"medium",
            "annotation"=>"bubble",
        ), 
        'facebook'=>array(
            'href'=>'https://www.facebook.com/QuickLic',//asociate your page http://www.facebook.com/page 
            'action'=>'recommend',//recommend, like
            'colorscheme'=>'light',
            'width'=>'120px',
            )
        )
));?>
                </div>
</div><!-- page -->

</body>
</html>
