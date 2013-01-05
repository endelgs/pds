<?php
/* @var $this LicitacoesController */
/* @var $model Licitacoes */

$this->breadcrumbs=array(
	'Licitacoes'=>array('index'),
	$model->id_licitacao=>array('view','id'=>$model->id_licitacao),
	'Update',
);

$this->menu=array(
	array('label'=>'List Licitacoes', 'url'=>array('index')),
	array('label'=>'Create Licitacoes', 'url'=>array('create')),
	array('label'=>'View Licitacoes', 'url'=>array('view', 'id'=>$model->id_licitacao)),
	array('label'=>'Manage Licitacoes', 'url'=>array('admin')),
);
?>

<h1>Update Licitacoes <?php echo $model->id_licitacao; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>