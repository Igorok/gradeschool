<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Управление пользователями</div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">


<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p>
Для повышения качества поиска пользуйтесь символами (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>)
</p>
<div>
    <?php echo CHtml::link('<i class="icon-file icon-white"></i>&nbsp;Создать', array('user/create'), array('class'=>'btn btn-primary')) ?>
    <!-- -->
    <?php echo CHtml::link('<i class="icon-search icon-white"></i>&nbsp;Расширеный поиск','#',array('class'=>'search-button btn btn-primary')); ?>

</div>
<div class="search-form" style="display:none">
<?php 
    $this->renderPartial('_search',array(
        'model'=>$model,
    ));
?>
</div><!-- search-form -->
<!-- -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'password',
		'email',
		'profession',
		array(
        'name'=>'image_thumb',
			'type'=>'image',
			//если файла картинки нет, 
			// то отображается файл noeventimage.png
			// Значение value обрабатывается функцией eval() поэтому 
			// одинарные ковычки.
			'value'=> 'file_exists($_SERVER["DOCUMENT_ROOT"] . Yii::app()->getBaseUrl() . Yii::app()->params["userThumbPath"] . $data->image_thumb) && !empty($data->image_thumb) ? Yii::app()->request->baseUrl . Yii::app()->params["userThumbPath"] . $data->image_thumb : Yii::app()->request->baseUrl . Yii::app()->params["userThumbPath"] . "noeventimage.png"',
			'filter'=>'',
			'headerHtmlOptions'=>array('width'=>'54px')
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
    'summaryText' => '<div class="show_report">Всего <b>{count}</b> пользователей, с {start} по {end}</div>',
)); ?>



        </div>
    </div>
    </div>
</div>