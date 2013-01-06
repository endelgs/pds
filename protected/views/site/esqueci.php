<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
        'Login'=>array('/site/login'),
	'Recuperação de senha',
);
?>
<div class="row span_6 center">
  <img class="center" src="<?php echo Yii::app()->baseUrl?>/images/logo.png">
  <h1>Recuperação de senha</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-esqueci-form',
	'enableAjaxValidation'=>false,
)); ?>
  
	
        <script type="text/javascript">
          jQuery(document).ready(function(){
            jQuery('.mensagem').fadeIn('slow');
          });

        </script>
        <?php if(!$reenvioOK):?>
        <p class="note">Digite seu e-mail de cadastro e lhe enviaremos sua senha</p>
        <?php if(!$first && !strlen($form->errorSummary($model))):?>
        <div id="mensagem-erro" style="display:block" class="row span_12 mensagem">Não existe um usuário com o e-mail informado em nossa base de dados - 
          <a class="red" href="javascript:;" onclick="jQuery(this.parentNode).fadeOut('slow')">Fechar</a></div>
          <?php else: ?>
	<?php echo $form->errorSummary($model); ?>
        <?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'recuperar-senha')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Recuperar minha senha'); ?>
	</div>
        <?php else: ?>
        <div style="display:block" class="row span_12 mensagem">Sua senha foi enviada para <em><?php echo $model->email ?></em>. Não se esqueça de olhar a caixa de Spam! - 
          <a class="red" href="javascript:;" onclick="jQuery(this.parentNode).fadeOut('slow')">Fechar</a></div>
          <?php echo CHtml::button("Já recebi minha senha! Quero fazer login!",array('onclick'=>'window.location = "'.Yii::app()->baseUrl.'/index.php/site/login?recovery=1"'))?>
        <?php endif;?>
  
<?php $this->endWidget(); ?>

</div><!-- form -->
</div>