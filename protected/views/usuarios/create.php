<?php $this->breadcrumbs=array(
	'Cadastre-se'
);
?>
<div class="row span_6 center">
<img src="<?php echo Yii::app()->baseUrl?>/images/logo.png"/>
<h1>Cadastre-se</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>