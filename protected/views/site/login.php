<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';

?>
<div class="row span_6 center clr">
  <img class="center" src="<?php echo Yii::app()->baseUrl?>/images/logo.png">
  <?php if(isset($_GET['msg']) && $_GET['msg'] == 'ok'):?>
  <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('.mensagem').fadeIn('slow');
    });
    
  </script>
  <div class="row span_10 mensagem">Parabéns! Agora você pode começar a receber informes sobre licitações de todo Brasil! 
    Faça login e entre no mundo das licitações e pregões eletrônicos públicos! - 
    <a class="red" href="javascript:;" onclick="jQuery(this.parentNode).fadeOut('slow')">Fechar</a></div>
<?php endif;?>
  <h1>Entre no QuickLic e tenha acesso a licitações de todo país!</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'col span_10')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'col span_10')); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
