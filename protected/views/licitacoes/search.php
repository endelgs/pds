<?php 
/**
 * @var $pages CPagination
 */

?>
<div class="busca-header">
  <div class="row">
    <span class="col span_2">
      <a href="<?php echo Yii::app()->createAbsoluteUrl('site/index')?>"><img class="logo-s" src="<?php echo Yii::app()->baseUrl?>/images/s_logo.png"></a>
    </span>
    <form action="<?php Yii::app()->createAbsoluteUrl('/licitacoes/search')?>" method="get">
      <span class="col span_9"><input type="text" name="query" id="barra-de-busca-results" value="<?php echo $_GET['query'] ?>" class="col span_7 barra-de-busca no-margin-top"/>
        <input type="submit" class="botao-procurar" id="botao-procurar-results" value="Procurar" />
        <input type="image" class="botao-procurar" id="mobile-botao-procurar-results" src="<?php echo Yii::app()->request->baseUrl; ?>/images/lupa.png"/>
      </span>
    </form>
  </div>
</div>
<ul class="resultados-busca row span_8 center">
  <?php if(count($dataProvider) == 0): ?>
  <h1>Não encontramos nenhum resultado para '<?php echo $_GET['query'] ?>'</h1>
  <p>Você pode tentar buscar por uma quantidade menor de termos ou com termos diferentes.</p>
  <?php else: ?>
  <h1><?php echo $pages->getItemCount() ?> resultados de busca por '<?php echo $_GET['query'] ?>'</h1>
  <?php $this->widget('CLinkPager', array(
    'pages' => $pages,
    'itemCount' => $pages->getItemCount(),
    'maxButtonCount' => 8
)) ?>
  <?php foreach($dataProvider as $obj):?>
  <li class="row span_12">
    <h3><a href="<?php echo Yii::app()->createAbsoluteUrl('licitacoes/view',array('id'=>$obj->id_licitacao));?>"><?php echo substr($obj->aviso_free,0,60).'...' ?></a></h3>
    <p><?php echo substr($obj->objeto_free,0,250).'...';?></p>
  </li>
  <?php endforeach; ?>
  <?php $this->widget('CLinkPager', array(
    'pages' => $pages,
    'itemCount' => $pages->getItemCount(),
    'maxButtonCount' => 8
)) ?>
<?php endif; ?>
</ul>