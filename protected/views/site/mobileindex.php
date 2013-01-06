<?php
/* @var $this SiteController */
$this->pageTitle= Yii::app()->name;
?>
<div class="row center span_6">
  <div class="col span_12 align-center">
    <img src="<?php echo Yii::app()->baseUrl?>/images/logo.png"/>
  </div>
  <form id="frm-busca" action="<?php echo Yii::app()->createAbsoluteUrl('licitacoes/search')?>" method="get">
    <div class="row">
      <span class="col span_12 help-busca">O que você está procurando? O QuickLic pode te ajudar a encontrar licitações e pregões eletrônicos públicos
      do seu interesse!</span>
    </div>
      <div class="row">
        <input type="text" id="barra-de-busca" name="query" class="col center span_11"/>
        <input type="image" class="botao-procurar" id="mobile-botao-procurar-results" src="<?php echo Yii::app()->request->baseUrl; ?>/images/lupa.png"/>
      </div>
    </div>
    <div id="mensagem-erro" class="clr row span_12">Digite algo para pesquisar! - 
    <a class="red" href="javascript:;" onclick="jQuery(this.parentNode).fadeOut('slow')">Fechar</a></div>
    
    </form>
  
  <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('#barra-de-busca').focus();
      jQuery('#frm-busca').bind('submit',function(){
        if(jQuery('#barra-de-busca').val().length < 3){
          jQuery('#mensagem-erro').fadeIn('slow');
          jQuery('#barra-de-busca').css('border','solid 1px #d00');
          return false;
        }
        return true;
      })
    });
  </script>
</div>