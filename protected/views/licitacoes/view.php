<?php
/* @var $this LicitacoesController */
/* @var $model Licitacoes */
$this->breadcrumbs=array(
      'Resultados de busca',
      'Licitação '.$_GET['id']
);
?>
<div class="row span_6 center">
  <img class="center logo" src="<?php echo Yii::app()->baseUrl?>/images/logo.png">
<?php if(Yii::app()->user->isGuest): // Visao 'free' ?>
  <h1>Exibindo licitação <?php echo CHtml::link('xx/xx/xx.xxx',array('site/page','view'=>'help'),array('title' => 'Por que estou vendo xxxx nos dados das licitações?'))?> de <?php echo CHtml::link('xxxx',array('site/page','view'=>'help'),array('title' => 'Por que estou vendo xxxx nos dados das licitações?'))?></h1>
<span class="subtitulo">Publicada em <?php echo $model->publicado_em ?></span>

<h2>Interessado</h2>
<p><?php echo ucwords($model->interessado) ?></p>
<h2>Aviso de licitação</h2>
<p><?php echo $model->aviso_free ?></p>

<h2>Objeto</h2>
<p><?php echo $model->objeto_free ?></p>

<?php else: ?>
<h1>Exibindo licitação <?php echo $model->protocolo; ?> de <?php echo $model->relCidade()->nome.' - '.$model->relCidade()->estado ?></h1>
<span class="subtitulo">Publicada em <?php echo $model->publicado_em ?></span>

<h2>Interessado</h2>
<p><?php echo ucwords($model->interessado) ?></p>
<h2>Aviso de licitação</h2>
<p><?php echo $model->aviso ?></p>

<h2>Objeto</h2>
<p><?php echo $model->objeto ?></p>

<?php endif; ?>
  <a class="col" href="javascript:history.back();"><< Voltar aos resultados</a>

</div>