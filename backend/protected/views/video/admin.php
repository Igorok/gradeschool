<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Управление видео</div>
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
	$('#video-grid').yiiGridView('update', {
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
    <?php echo CHtml::link('<i class="icon-file icon-white"></i>&nbsp;Создать', array('video/create'), array('class'=>'btn btn-primary')) ?>
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
	'id'=>'video-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'short_description',
		array(
        'name'=>'image_name',
			'type'=>'image',
			//если файла картинки нет, 
			// то отображается файл noeventimage.png
			// Значение value обрабатывается функцией eval() поэтому 
			// одинарные ковычки.
			'value'=> 'file_exists($_SERVER["DOCUMENT_ROOT"] . Yii::app()->getBaseUrl() . Yii::app()->params["userVideosPath"] . $data->image_name) && !empty($data->image_name) ? Yii::app()->request->baseUrl . Yii::app()->params["userVideosPath"] . $data->image_name : Yii::app()->request->baseUrl . Yii::app()->params["userVideosPath"] . "noeventimage.png"',
			'filter'=>'',
			'headerHtmlOptions'=>array('width'=>'54px')
        ),
		'link',
		/*
		'create_time',
		'category_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
    'summaryText' => '<div class="show_report">Всего <b>{count}</b> видео, с {start} по {end}</div>',
)); ?>








        </div>
    </div>
    </div>
</div>