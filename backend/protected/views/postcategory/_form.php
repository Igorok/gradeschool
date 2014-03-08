<?php
/* @var $this PostCategoryController */
/* @var $model PostCategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_url'); ?>
		<?php echo $form->textField($model,'page_url'); ?>
		<?php echo $form->error($model,'page_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_keywords'); ?>
		<?php echo $form->textField($model,'meta_keywords'); ?>
		<?php echo $form->error($model,'meta_keywords'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'meta_description'); ?>
		<?php echo $form->textArea($model,'meta_description'); ?>
		<?php echo $form->error($model,'meta_description'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class'=>'btn btn-success')); ?>
		<input type="button" value="Отмена" onClick="this.form.reset()" class="btn btn-danger" />
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->