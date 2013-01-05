<?php /* @var $this Controller */ 
//echo $_SERVER['HTTP_USER_AGENT'];die();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
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
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mobile.css" media="screen"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
</head>

<body>
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
                                array('label' => 'Busca Avançada*', 'url' => 'javascript:;'),
				array('label' => 'Sobre nós', 'url'=>array('/site/page', 'view'=>'about')),
                                array('label' =>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                array('label' =>'Meu Cadastro', 'url'=>array('/usuarios/update'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label' => 'Ajuda', 'url'=>array('/site/page', 'view'=>'help')),
			),
                        'htmlOptions' => array('class'=> 'col span_8'),
		)); ?>
          <ul class="col span_4" style='float:right;margin-right:10px; color:#fff;font-weight:bold;'>
            <li>Olá
          <?php
          // Exibindo o nome do usuario no canto direito
          if(Yii::app()->user->isGuest){
            echo " Visitante </li><li> ".CHtml::link('Cadastre-se',array('/usuarios/create'),array('class'=>'highlight'));
          }else{
            echo " ".Yii::app()->user->name." </li><li> ".CHtml::link('Logoff',array('/site/logout'));
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

</div><!-- page -->

</body>
</html>
