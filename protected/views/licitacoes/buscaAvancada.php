<?php
/* @var $this LicitacoesController */
/* @var $model Licitacoes */

$this->breadcrumbs = array(
    'Busca avançada' => array('index')
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('licitacoes-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="row span_10 center">
  <h1>Busca avançada</h1>

  <p>
    Você pode utilizar operadores de comparação(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    ou <b>=</b>) no começo de cada termo de busca para especificar o tipo de comparação a ser feita.
  </p>

  <?php echo CHtml::link('Busca Avançada', '#', array('class' => 'search-button')); ?>
  <div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
  </div><!-- search-form -->

  <?php
  $this->widget('zii.widgets.grid.CGridView', array(
      'id' => 'licitacoes-grid',
      'dataProvider' => $model->search(),
      'filter' => $model,
      'columns' => array(
          'protocolo',
          'interessado',
          'objeto',
          'publicado_em',
          array(
              'filter' => CHtml::listData(Cidades::model()->findAll(), 'id_cidade', 'nome'),
              'name' => 'id_cidade',
              'value' => '$data->relCidade->nome',
              'htmlOptions' => array('style' => 'width:100px')
          ),
          /*array(
              'filter' => CHtml::listData(Modalidades::model()->findAll(), 'modalidade', 'nome'),
              'name' => 'modalidade',
              'value' => '$data->relModalidade'
          ),*/
      ),
  ));
  ?>

</div>