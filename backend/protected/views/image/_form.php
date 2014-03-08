<?php
/* @var $this ImageController */
/* @var $model Image */
/* @var $form CActiveForm */
?>
<script>
$(document).ready(function() {
    var wbbOpt = {
      buttons: "bold,italic,underline,|,fontcolor,fontsize,|,bullist,numlist,|,img,link",
      imgupload: false,
    }
    $('#Image_full_description').wysibb(wbbOpt);
})
</script>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'image-form',
	'enableAjaxValidation'=>false,
    "htmlOptions" => array("enctype" => "multipart/form-data"),
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'short_description'); ?>
		<?php echo $form->textField($model,'short_description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'short_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'full_description'); ?>
		<?php echo $form->textArea($model,'full_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'full_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image_name'); ?>
		<?php echo $form->fileField($model,'image_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'image_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textArea($model,'link',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php
			echo CHtml::dropDownList('Image[category_id]', '1',
			$list_data,
			array('empty' => 'Выбрать категорию'));
		?>
		<?php echo $form->error($model,'category_id'); ?>
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