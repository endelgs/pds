<?php
/* @var $this LicitacoesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Licitacoes',
);

$this->menu=array(
	array('label'=>'Create Licitacoes', 'url'=>array('create')),
	array('label'=>'Manage Licitacoes', 'url'=>array('admin')),
);
?>

<h1>Licitacoes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
