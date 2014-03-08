
<script type="text/javascript" >
 // registarion page
 $(function(){
	 $('#filename').live('change', function() {
		$("#preview").html('');
		$("#preview").html('<img class="load_img" src="' + '<?= Yii::app()->request->baseUrl . Yii::app()->params["imagePath"]; ?>' + '/loader.gif" alt="Загрузка..."/>');
		// ajax upload
		$("#imageform").ajaxForm({
			target: '#preview',
			dataType: 'json',
			success: function(data) {
				// если статус ок
				if(data['status'] == 1) {
					$(".ava_case").show();
					// в бегунок вставляем картинку
					$("#preview").html('<img id="cropbox" src="' + '<?= Yii::app()->request->baseUrl . Yii::app()->params["previewPath"]; ?>' + data["answer"] + '" alt="Загрузка..."/>');
					//в форму jcrop имя картинки
					$('#image_name').val(data['answer']);
					$('#cropbox').Jcrop({
						aspectRatio: 1,
						onSelect: updateCoords
					});
				}
				// если статус ошибка
				else if (data['status'] == 2) {
					$('#preview').html(
						'<div class="alert alert-danger">' + data['answer'] + '</div>'
					);
				}				
			}
		}).submit();
	});

	$("#jcrop_form").submit(function(){
		$.ajax({
			type: "POST",
			url: '/site/jcrop/',
			dataType : "json",
			data:{x:$('#x').val(), y:$('#y').val(), w:$('#w').val(), h:$('#h').val(), image_name:$('#image_name').val()},
			success: function(data) {
				$(".result_img").show();
				$(".black_back, .ajaxupload").hide();
				$(".result_img").html('<img id="cropbox" src="' + '<?= Yii::app()->request->baseUrl . Yii::app()->params["previewPath"]; ?>' + data + '?123" alt="Ваша итоговая аватарка"/>');
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

<!-- popup -->
<div class="ajaxupload">
	<div class="aj_close">
		<span class="glyphicon glyphicon-remove"></span>
	</div>
	<h3>Добавить фотографию</h3>
	<form id="imageform" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->request->baseUrl ?>/site/imageupload/">
	<div>
		<input type="file" name="ImageUpload[filename]" id="filename" />
	</div>
	</form>
	<div id="preview"></div>
	<div class="ava_case">
		<form id="jcrop_form" action="<?php echo Yii::app()->request->baseUrl ?>/site/jcrop/" method="post" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="hidden" id="image_name" name="image_name" />
			<input type="submit" value="Выбрать" class="btn btn-success" />
		</form>
	</div>
</div>
<!-- popup end -->

<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/frontend/js/jquery.form.js');
	$cs->registerScriptFile($baseUrl.'/frontend/js/jquery.Jcrop.min.js');
	$cs->registerCssFile($baseUrl.'/frontend/css/jquery.Jcrop.min.css');
?>


<div class="container row">
	<div class="col-md-6">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-form',
		'enableAjaxValidation'=>false,
	)); ?>

		<p class="note">Поля со <span class="required">*</span> обязательны.</p>

		<?php echo $form->errorSummary($model, 'Исправьте, пожалуйста, следующие ошибки:'); ?>
		
		
		<div class="">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username',array('size'=>60, 'maxlength'=>128, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password',array('size'=>60, 'maxlength'=>128, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
		<div class="">
			<?php echo $form->labelEx($model,'password_repeat'); ?>
			<?php echo $form->passwordField($model,'password_repeat',array('size'=>60, 'maxlength'=>128, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'password_repeat'); ?>
		</div>

		<div class="">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('size'=>60, 'maxlength'=>128, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		
		<div class="">
			<?php echo $form->labelEx($model,'fio'); ?>
			<?php echo $form->textField($model,'fio',array('size'=>60, 'maxlength'=>128, 'class'=>'form-control')); ?>
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
					'class'=>'form-control',
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
		
		<div class=" buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class'=>'btn btn-success')); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div>

	<!-- user img -->
	<div class="col-md-6">
		<div class="result_img">
			<div class="image_upload btn btn-default">
				<span class="glyphicon glyphicon-picture"></span>
				Выбрать фотографию
			</div>
		</div>
	</div>

</div><!-- form -->


