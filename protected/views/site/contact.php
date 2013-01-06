<div class="row center span_6">
  <img class="center" src="<?php echo Yii::app()->baseUrl?>/images/logo.png">
<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contato';
$this->breadcrumbs=array(
	'Contato',
);
?>

<h1>Contato</h1>

<?php if(Yii::app()->user->hasFlash('contact')): 
  Yii::app()->user->setFlash('contact',"Obrigado por entrar em contato conosco! Responderemos o mais breve possível!");
  ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
Você tem alguma dúvida sobre o funcionamento do nosso site? Gostaria que sua cidade
fosse incluída nas buscas? Deixe uma mensagem para nós que responderemos o mais rápido possível!
</p>
<br/><br/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>128,'class'=>'col span_12')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('maxlength'=>128,'class'=>'col span_12')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('maxlength'=>128,'class'=>'col span_12')); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6,'class'=>'col span_12')); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
          <?php echo $form->labelEx($model,'verifyCode'); ?>
          <?php $this->widget('CCaptcha'); ?>
        </div>
          <div class="row">
          
          <?php echo $form->textField($model,'verifyCode',array('maxlength'=>128,'class'=>'col span_12')); ?>
          </div>
          <div class="hint">Digite o código anti-robô acima.
          <br/>O sistema não diferencia maiúsculas e minúsculas.</div>
          <?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
</div>