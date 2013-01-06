<?php
/* @var $this LicitacoesController */
/* @var $model Licitacoes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'protocolo'); ?>
		<?php echo $form->textField($model,'protocolo',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interessado'); ?>
		<?php echo $form->textField($model,'interessado',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'objeto'); ?>
		<?php echo $form->textArea($model,'objeto',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'publicado_em'); ?>
		<?php echo $form->textField($model,'publicado_em'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aviso'); ?>
		<?php echo $form->textArea($model,'aviso',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'relCidade'); ?>
		<?php echo $form->dropDownList($model,'id_cidade',CHtml::listData(Cidades::model()->findAll(), 'id_cidade', 'nome')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->