<?php /* @var $this Controller */ 
//echo $_SERVER['HTTP_USER_AGENT'];die();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>	
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
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
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        
</head>

<body>
  
<div class="container" id="page">
    <div class="mobile-menu">
      
      <ul class="rightmenu">
        <?php if(Yii::app()->user->isGuest): ?>
        <li><?php echo CHtml::link('<img title="Login" src="'.Yii::app()->request->baseUrl.'/images/lock.png"/>',array('/site/login')) ?></li>
        <?php else:
        $u = Usuarios::model()->findByPk(Yii::app()->user->id);
            $nome = (strlen($u->nome) > 0)?$u->nome:$u->nome_usuario;
            echo CHtml::link("Olá ".$nome,array('usuarios/update'),array('style'=>'text-decoration:underline'))." </li><li> ".CHtml::link('Logoff',array('site/logout'));
           endif ;?>
      </ul>
      <ul>
        <li><?php echo CHtml::link('<img title="Página Inicial" src="'.Yii::app()->request->baseUrl.'/images/home.png"/>',array('/site/index')) ?></li>
        <li><?php echo CHtml::link('<img title="Contato" src="'.Yii::app()->request->baseUrl.'/images/fone.png"/>',array('/site/contact')) ?></li>
        <li><?php echo CHtml::link('<img title="Ajuda" src="'.Yii::app()->request->baseUrl.'/images/help.png"/>',array('/site/page','view'=>'help')) ?></li>
      </ul>
    </div>
	<!-- div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
        
	<?php echo $content; ?>

	<div class="clear"></div>

	<!-- div id="footer" class="col span_12">
		Copyright &copy; <?php echo date('Y'); ?> by IHC & PDS Company.<br/>
		<?php echo Yii::powered(); ?> and PHP
	</div><!-- footer -->
</div><!-- page -->

</body>
</html>
