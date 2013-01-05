<?php
/* @var $this LicitacoesController */
/* @var $data Licitacoes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_licitacao')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_licitacao), array('view', 'id'=>$data->id_licitacao)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('protocolo')); ?>:</b>
	<?php echo CHtml::encode($data->protocolo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interessado')); ?>:</b>
	<?php echo CHtml::encode($data->interessado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('objeto')); ?>:</b>
	<?php echo CHtml::encode($data->objeto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('objeto_free')); ?>:</b>
	<?php echo CHtml::encode($data->objeto_free); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publicado_em')); ?>:</b>
	<?php echo CHtml::encode($data->publicado_em); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aviso')); ?>:</b>
	<?php echo CHtml::encode($data->aviso); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('aviso_free')); ?>:</b>
	<?php echo CHtml::encode($data->aviso_free); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('outros')); ?>:</b>
	<?php echo CHtml::encode($data->outros); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('all_data')); ?>:</b>
	<?php echo CHtml::encode($data->all_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cidade')); ?>:</b>
	<?php echo CHtml::encode($data->id_cidade); ?>
	<br />

	*/ ?>

</div>