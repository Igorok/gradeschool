<?php
	$this->pageTitle=Yii::app()->name . ' - Связаться с нами';
	$this->pageMetaDescription = 'Если у Вас есть вопросы, вы можете написать нам, воспользовавшись этой формой';
	$this->pageMetaKeywords = 'Связаться с нами';
	$this->breadcrumbs=array(
		'Связаться с нами',
	);
?>

<h3>Связаться с нами</h3>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
    Если у Вас есть вопросы, вы можете написать нам, воспользовавшись этой формой.
</p>
<p>
    С уважением, администрация сайта.
</p>

<div class="form_case">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableAjaxValidation'=>true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
		'validateOnChange' => false,
	),
	)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

	<div class="">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body', array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'body'); ?>
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
	<?php echo CHtml::ajaxSubmitButton('Отправить', '', array(
		'class'=>'btn btn-default',
	    'dataType'=>'json',
	    'type' => 'POST',
	    'update' => '#output',
	    'success' => 'function(data) {
			if (data.indexOf("{")== 0 ) {
				var json = $.parseJSON(data);

				$.each(json, function(key, value) {
					$("#" + key).addClass("clsError");
					$("#" + key + "_em_").show().html(value.toString());
				});
			}
			else{
				$("#contact-form").html("<div class=\"alert alert-success\">" + data + "</div>");
			}
		}',
		'error' => 'function(data){
			alert(data);
		}'
	),
	array(
	    // Меняем тип элемента на submit, чтобы у пользователей
	    // с отключенным JavaScript всё было хорошо.
	    'type' => 'submit',
	    'class'=>'btn btn-success',
	)); ?>
	<div id="output"></div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>