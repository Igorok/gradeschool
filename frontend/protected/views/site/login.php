<?php
	$this->pageTitle='Авторизация';
	$this->pageMetaDescription = 'Авторизация';
    $this->pageMetaKeywords = 'Авторизация';
	$this->breadcrumbs=array(
	'Авторизация',
);
?>

<h3>Войти с помощью аккаунта на сайте</h3>

<div class="col-md-6">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
		'validateOnChange' => false,
	),
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны.</p>

	<div class="">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class=" rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class=" submit">
		<?php echo CHtml::ajaxSubmitButton('Войти', '', array(
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
					else {
						if (data == 2){
							var message = "Аккаунт заблокирован";
							messageModal(message);
						}
						else {
							document.location.href="/user/account";
						}
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
