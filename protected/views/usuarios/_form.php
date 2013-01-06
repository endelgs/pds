<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	'enableAjaxValidation'=>true,
));
$disabled = '';

?>      
	<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>
        <?php if(!Yii::app()->user->isGuest){$disabled = 'disabled';} ?>
        <div class="row">
		<?php echo $form->labelEx($model,'nome',array('class'=>'row')); ?>
		<?php echo $form->textField($model,'nome',array('maxlength'=>50,'class'=>'col span_10 clr')); ?>
                <span class="help">Ex: João da Silva</span>
		<?php echo $form->error($model,'nome'); ?>
	</div>
        <div class="row">
          <label>Tipo de cadastro</label><br/>
          <input type="radio" name="tipoPessoa" onclick="$('#documento').mask('999.999.999-99')"/>Pessoa física 
          <input type="radio" name="tipoPessoa" onclick="$('#documento').mask('99.999.999/9999-99')"/>Pessoa jurídica
        </div>
        <div class="row">
          
		<?php echo $form->labelEx($model,'documento',array('class'=>'row')); ?>
                <?php 
                  $this->widget('CMaskedTextField', array(
                  'model' => $model,
                  'attribute' => 'documento',
                  'mask' => '99.999.999-99',
                  'htmlOptions' => array('id'=>'documento','maxlength'=>50,'class'=>'col span_10 clr')
                  ));
                ?>
		<?php // echo $form->textField($model,'documento',array('id'=>'documento','maxlength'=>50,'class'=>'col span_10 clr','onblur'=>'')); ?>
                <span class="help">Você pode digitar seu CPF ou CNPJ. Somente números. Ex: 22558011839</span>
		<?php echo $form->error($model,'documento'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'nome_usuario',array('class'=>'row')); ?>
		<?php echo $form->textField($model,'nome_usuario',array('maxlength'=>50,'class'=>'col span_10 clr','disabled'=>$disabled)); ?>
                <span class="help">Ex: joaosilva123 </span>
		<?php echo $form->error($model,'nome_usuario'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'senha'); ?>
		<?php echo $form->passwordField($model,'senha',array('maxlength'=>50,'class'=>'col span_10 clr')); ?>
                <span class="help">Sua senha deve ter no mínimo 6 caracteres. Ex: J04051LV4</span>
		<?php echo $form->error($model,'senha'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'confirmacao_senha'); ?>
		<?php echo $form->passwordField($model,'confirmacao_senha',array('maxlength'=>50,'class'=>'col span_10 clr')); ?>
                <span class="help">Isso é importante para que você ter certeza da senha que digitou!</span>
		<?php echo $form->error($model,'confirmacao_senha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'col span_10 clr')); ?>
                <span class="help">Ex: joaosilva@gmail.com</span>
		<?php echo $form->error($model,'email'); ?>
	</div>
        <?php echo $form->hiddenField($model,'tipo_usuario',array('value'=>'admin'));?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'OK, Finalize meu cadastro!' : 'Corrigir meus dados'); ?>
          <?php if(!$model->isNewRecord): ?>
            <?php echo CHtml::ajaxButton('Excluir meu cadastro!',array('/usuarios/ajaxDelete'),array('type'=> 'POST','data' => array('id'=>$model->id_usuario),'success'=>'update()'),array('onclick'=>'confirm("Você tem certeza que deseja excluir sua conta?\nVocê não terá mais direito a acessar as informações contidas neste site")')); ?>
          <?php endif; ?>
	</div>
        <script>
        function update(){
          $("#update_selector").fadeIn("slow");
        }  
      </script>
        <div class="mensagem" id="update_selector">
          Sua conta foi excluída! <?php echo CHtml::link("Voltar para página principal",array("/site/index"))?>
        </div>
<?php $this->endWidget(); ?>
</div><!-- endform -->