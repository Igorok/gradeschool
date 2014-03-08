<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">О сайте</div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">
        
        

<?php
/* @var $this AboutController */
/* @var $model About */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#about-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->pageTitle='О сайте';
?>


<p>
Для повышения качества поиска пользуйтесь символами (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>)
</p>
<div>
    <?php echo CHtml::link('<i class="icon-file icon-white"></i>&nbsp;Создать', array('about/create'), array('class'=>'btn btn-primary')) ?>
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

<?php 




$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'about-grid',
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
			'value'=> 'file_exists($_SERVER["DOCUMENT_ROOT"] . Yii::app()->getBaseUrl() . Yii::app()->params["imagePath"] . $data->image_name) && !empty($data->image_name) ? Yii::app()->request->baseUrl . Yii::app()->params["imagePath"] . $data->image_name : Yii::app()->request->baseUrl . Yii::app()->params["imagePath"] . "noeventimage.png"',
			'filter'=>'',
			'headerHtmlOptions'=>array('width'=>'54px')
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
    'summaryText' => '<div class="show_report">Всего <b>{count}</b> постов, с {start} по {end}</div>',
	 'template' => "{summary}{pager}{items}{pager}",
)); ?>


        </div>
    </div>
    </div>
</div>