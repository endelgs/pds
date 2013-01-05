<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	'enableAjaxValidation'=>false,
));
$disabled = '';
?>
      
	<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>
        <?php if(!Yii::app()->user->isGuest){$disabled = 'disabled';} ?>
	<div class="row">
		<?php echo $form->labelEx($model,'nome_usuario',array('class'=>'row')); ?>
		<?php echo $form->textField($model,'nome_usuario',array('maxlength'=>50,'class'=>'col span_10 clr','disabled'=>$disabled)); ?>
		<?php echo $form->error($model,'nome_usuario'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'senha'); ?>
		<?php echo $form->passwordField($model,'senha',array('maxlength'=>50,'class'=>'col span_10 clr')); ?>
		<?php echo $form->error($model,'senha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'col span_10 clr')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'OK, Finalize meu cadastro!' : 'Corrigir meus dados'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- endform -->