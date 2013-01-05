<?php
/* @var $this LicitacoesController */
/* @var $model Licitacoes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'licitacoes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'protocolo'); ?>
		<?php echo $form->textField($model,'protocolo',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'protocolo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'interessado'); ?>
		<?php echo $form->textField($model,'interessado',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'interessado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'objeto'); ?>
		<?php echo $form->textArea($model,'objeto',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'objeto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'objeto_free'); ?>
		<?php echo $form->textArea($model,'objeto_free',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'objeto_free'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publicado_em'); ?>
		<?php echo $form->textField($model,'publicado_em'); ?>
		<?php echo $form->error($model,'publicado_em'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aviso'); ?>
		<?php echo $form->textArea($model,'aviso',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'aviso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aviso_free'); ?>
		<?php echo $form->textField($model,'aviso_free',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'aviso_free'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'outros'); ?>
		<?php echo $form->textArea($model,'outros',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'outros'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'all_data'); ?>
		<?php echo $form->textArea($model,'all_data',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'all_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cidade'); ?>
		<?php echo $form->textField($model,'id_cidade'); ?>
		<?php echo $form->error($model,'id_cidade'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->