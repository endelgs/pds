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
		<?php echo $form->label($model,'id_licitacao'); ?>
		<?php echo $form->textField($model,'id_licitacao'); ?>
	</div>

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
		<?php echo $form->label($model,'objeto_free'); ?>
		<?php echo $form->textArea($model,'objeto_free',array('rows'=>6, 'cols'=>50)); ?>
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
		<?php echo $form->label($model,'aviso_free'); ?>
		<?php echo $form->textField($model,'aviso_free',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'outros'); ?>
		<?php echo $form->textArea($model,'outros',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'all_data'); ?>
		<?php echo $form->textArea($model,'all_data',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cidade'); ?>
		<?php echo $form->textField($model,'id_cidade'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->