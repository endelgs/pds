<?php
/* @var $this LicitacoesController */
/* @var $model Licitacoes */

$this->breadcrumbs=array(
	'Licitacoes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Licitacoes', 'url'=>array('index')),
	array('label'=>'Manage Licitacoes', 'url'=>array('admin')),
);
?>

<h1>Create Licitacoes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>