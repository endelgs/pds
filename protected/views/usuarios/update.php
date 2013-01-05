<div class="row span_6 center">
<?php echo CHtml::image(Yii::app()->baseUrl."/images/logo.png","QuickLic");?>

<?php if(isset($cadastroOK)):?>
  <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('.mensagem').fadeIn('slow');
    });
    
  </script>
  <div class="row span_10 mensagem">Seus dados foram alterados com sucesso! - 
    <a class="red" href="javascript:;" onclick="jQuery(this.parentNode).fadeOut('slow')">Fechar</a></div>
<?php endif;?>
<h1>Meu Cadastro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>