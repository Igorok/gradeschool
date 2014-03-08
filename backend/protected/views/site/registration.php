


<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/frontend/js/jquery.form.js');
	$cs->registerScriptFile($baseUrl.'/frontend/js/jquery.Jcrop.min.js');
	$cs->registerCssFile($baseUrl.'/frontend/css/jquery.Jcrop.min.css');
?>

<?php
$this->pageTitle=Yii::app()->name . ' - Регистрация';
$this->breadcrumbs=array(
	'Регистрация',
);
?>

<h1>Регистрация</h1>


<script type="text/javascript" >
 // registarion page
 $(function(){
	 $('#filename').live('change', function() {
		$("#preview").html('');
		$("#preview").html('<img class="load_img" src="<?php echo Yii::app()->request->baseUrl ?>/frontend/images/loader.gif" alt="Загрузка..."/>');
		// ajax upload
		$("#imageform").ajaxForm({
			target: '#preview',
			dataType: 'json',
			success: function(data) {
				$(".ava_case").show();
				$("#preview").html('<img id="cropbox" src="<?php echo Yii::app()->request->baseUrl ?>/frontend/images/image_preview/'+data+'" alt="Загрузка..."/>');
				$('#image_name').val(data);
				$('#cropbox').Jcrop({
					aspectRatio: 1,
					onSelect: updateCoords
				});
			}
		}).submit();
	});
		
	// jcrop
	// ajax jcrop
	/*
		$("#jcrop_form").ajaxForm({
			//target: '.result_img',
			dataType: 'json',
			type: 'POST',
			
			success: function(data) {
				if(data=='error'){
					return false;
				}else {
					$(".result_img").show();
					$(".ava_case, #preview").hide();
					$(".result_img").prepend('<img id="cropbox" src="<?php echo Yii::app()->request->baseUrl ?>/frontend/images/image_preview/'+data+'" alt="Ваша итоговая аватарка"/>');
					$('#User_image_name').val(data);
				}
				
			}
		}).submit();
	*/
	
	$("#jcrop_form").submit(function(){
		$.ajax({
			type: "POST",
			url: '/site/jcrop/',
			dataType : "json",
			//data: "x="+$('#x').val()+"&y="+$('#y').val()+"&w="+$('#w').val()+"&h="+$('#h').val()+"&image_name="+$('#image_name').val(),
			data:{x:$('#x').val(), y:$('#y').val(), w:$('#w').val(), h:$('#h').val(), image_name:$('#image_name').val()},
			success: function(data) {
				$(".result_img").show();
				$(".ava_case, #preview, #imageform").hide();
				$(".result_img").prepend('<img id="cropbox" src="<?php echo Yii::app()->request->baseUrl ?>/frontend/images/image_preview/'+data+'?123" alt="Ваша итоговая аватарка"/>');
				$('#User_image_name').val(data);
			}
		});
		return false;
	});
	
	
		
	
	

	function updateCoords(c)
	{
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	};
	

});
function checkCoords() {
	if (parseInt($('#w').val())) return true;
	alert('Укажите нужную область на изображении');	
	return false;
};
</script>
<div class="ajaxupload">
	<div class="aj_close">x</div>
	<h1>Добавить фотографию</h1>
	<!-- -->
	<form id="imageform" method="post" enctype="multipart/form-data" action="/site/imageupload/">
	<div>
		<input type="file" name="ImageUpload[filename]" id="filename" />
	</div>
	</form>
	<div id="preview"></div>
	<!-- -->
	<div class="ava_case">
		<!-- This is the form that our event handler fills -->
		<form id="jcrop_form" action="/site/jcrop/" method="post" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="hidden" id="image_name" name="image_name" />
			<input type="submit" value="Выбрать" class="btn btn-large btn-inverse" />
		</form>
	</div>
	<div class="result_img">
		<div class="aj_success green-button">Выбрать</div>
	</div>
</div>
<!-- -->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model, 'Исправьте, пожалуйста, следующие ошибки:'); ?>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'password_repeat'); ?>
		<?php echo $form->passwordField($model,'password_repeat',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password_repeat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="image_upload green-button">
		Выбрать фотографию
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'fio'); ?>
		<?php echo $form->textField($model,'fio',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'fio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'about'); ?>
		<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'about'); ?>
	</div>

	<div class="row">
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
				'style'=>'height:30px;'
			),
		));
		?>

		<?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profession'); ?>
		<?php echo $form->textField($model,'profession',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'profession'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'image_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div class="reg_captcha">
			<?php $this->widget('CCaptcha', array('buttonLabel' => 'обновить код')); ?>
		</div>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<div class="hint">Введите код с картинки.</div>
	</div>
	<?php endif; ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Регистрация' : 'Редактировать', array('class'=>'green-button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


