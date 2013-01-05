<?php
/* @var $this SiteController */
$this->pageTitle= Yii::app()->name;
?>
<div class="row center span_6">
  <div class="col span_12 align-center">
    <img src="<?php echo Yii::app()->baseUrl?>/images/logo.png"/>
  </div>
  mobile
  <form id="frm-busca" action="<?php echo Yii::app()->createAbsoluteUrl('licitacoes/search')?>" method="get">
    <div class="row">
      <span class="col span_12 help-busca">O que você está procurando? O QuickLic pode te ajudar a encontrar licitações e pregões eletrônicos públicos
      do seu interesse!</span>
    </div>
      <div class="row">
        <input type="text" id="barra-de-busca" name="query" class="col span_12 barra-de-busca center"/>
        <input type="image" class="botao-procurar" id="mobile-botao-procurar-results" src="<?php echo Yii::app()->request->baseUrl; ?>/images/lupa.png"/>
      </div>
    </div>
    <div id="mensagem-erro" class="clr row span_12">Digite algo para pesquisar! - 
    <a class="red" href="javascript:;" onclick="jQuery(this.parentNode).fadeOut('slow')">Fechar</a></div>
    
    </form>
  <!-- h1>jCloud Example</h1 -->
<?php /*$this->widget('ext.jcloud.JCloud', array(
    'id'=>'my_favorite_latin_words',
    'htmlOptions'=>array('style'=>'width: 300px; height: 100px;'),
    'wordList'=>array(
        array(
            'text'=> "Lorem",
            'weight'=> 13,
            'url'=> "https://github.com/DukeLeNoir/jQCloud"
            ),
        array(
            'text'=> "Ipsum",
            'weight'=> 10.5,
            'url'=> "http://jquery.com/"            ,
            'title'=> "jQuery"
        ),
        array(
            'text'=> "Dolor Script",
            'weight'=> 9.4,
            'url'=> "javascript:alert('JavaScript in URL is OK!');"
        ),
        array(
            'text'=> "Sit",
            'weight'=> 8,
        ),
        array(
            'text'=> "Amet",
            'weight'=> 6.2,
        ),
        array(
            'text'=> "Consectetur",
            'weight'=> 5,
        ),
        array(
            'text'=> "Adipiscing",
            'weight'=> 5,
            'url'=> ""
        ),
        array(
            'text'=> "Elit",
            'weight'=> 5,
            'url'=> ""
        ),
        array(
            'text'=> "Nam et",
            'weight'=> 13,            
        ),
        array(
            'text'=> "Yii-extension",
            'weight'=> 8,
            'url'=> "http://www.yiiframework.com/extensions/"
        ),
        array(
            'text'=> "Leo",
            'weight'=> 4,
        ),
        array(
            'text'=> "Homo Sapiens",
            'weight'=> 7,
        ),
        array(
            'text'=> "Pellentesque",
            'weight'=> 3,
            'url'=> ""
        ),
        array(
            'text'=> "at molestie",
            'weight'=> 1,            
        ),
    )
));*/ ?><!-- cloud -->
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