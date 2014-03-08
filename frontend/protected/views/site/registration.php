<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/frontend/js/jquery.form.js');
	$cs->registerScriptFile($baseUrl.'/frontend/js/jquery.Jcrop.min.js');
	$cs->registerCssFile($baseUrl.'/frontend/css/jquery.Jcrop.min.css');

	$this->pageTitle='Регистрация';
	$this->pageMetaDescription = 'Регистрация';
    $this->pageMetaKeywords = 'Регистрация';
	$this->breadcrumbs=array(
		'Регистрация',
	);
?>


<h3>Регистрация</h3>

<!-- form start	-->
<div class="container row">
	<div class="col-md-6">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	)); ?>

		<p class="note">Поля со <span class="required">*</span> обязательны.</p>

		<?php echo $form->errorSummary($model, 'Исправьте, пожалуйста, следующие ошибки:'); ?>
		
		
		<div class="">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
		<div class="">
			<?php echo $form->labelEx($model,'password_repeat'); ?>
			<?php echo $form->passwordField($model,'password_repeat',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'password_repeat'); ?>
		</div>

		<div class="">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		<div class="">
			<?php echo $form->labelEx($model,'fio'); ?>
			<?php echo $form->textField($model,'fio',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'fio'); ?>
		</div>

		<div class="">
			<?php echo $form->labelEx($model,'about'); ?>
			<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'about'); ?>
		</div>

		<div class="">
			<?php echo $form->labelEx($model,'dob'); ?>
			
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'name'=>'User[dob]',
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'changeMonth' => 'true',
					'changeYear' => 'true',
					'yearRange' => '1940:2010',
				),
				'htmlOptions'=>array(
					'class'=>'form-control'
				),
			));
			?>

			<?php echo $form->error($model,'dob'); ?>
		</div>

		<div class="">
			<?php echo $form->labelEx($model,'profession'); ?>
			<?php echo $form->textField($model,'profession',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'profession'); ?>
		</div>

		<div class="">
			<?php echo $form->hiddenField($model,'image_name',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		</div>
		
		<?php if(CCaptcha::checkRequirements()): ?>
		<div class="">
			<?php echo $form->labelEx($model,'verifyCode'); ?>
			<div class="reg_captcha">
				<?php $this->widget('CCaptcha', array('buttonLabel' => 'обновить код')); ?>
			</div>
			<?php echo $form->textField($model,'verifyCode', array('class'=>'form-control')); ?>
			<div class="hint">Введите код с картинки.</div>
			<?php echo $form->error($model,'verifyCode'); ?>
		</div>
		<?php endif; ?>
		
		
		<div class=" buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Регистрация' : 'Редактировать', array('class'=>'btn btn-success')); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div>
	<!-- user img -->
	<div class="col-md-6">
		<div class="result_img"></div>
	</div>
</div>


