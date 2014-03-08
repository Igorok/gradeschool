<?php
	/* @var $this PostController */
	/* @var $model Post */
	/* @var $form CActiveForm */
	Yii::app()->clientScript->registerScript('wysibbPost','
        var wbbOpt = {
          buttons: "bold,italic,underline,|,fontcolor,fontsize,|,bullist,numlist,|,img,link",
          imgupload: false,
        }
        $("#Post_full_description").wysibb(wbbOpt);
    '); 
?>

<div class="post_form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'short_description'); ?>
		<?php echo $form->textField($model,'short_description',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'short_description'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'full_description'); ?>
		<?php echo $form->textArea($model,'full_description'); ?>
        <?php echo $form->error($model,'full_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image_name'); ?>
		<?php echo $form->fileField($model,'image_name'); ?>
		<?php echo $form->error($model,'image_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		
		<?= CHtml::dropDownList('Post[category_id]', '1', 
              $list,
              array('class'=>'form-control')
            );
		?>
		
		<?php echo $form->error($model,'category_id'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->