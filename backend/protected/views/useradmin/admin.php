<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Управление администраторами</div>
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
Вы можете пользоваться операторами (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) для выбора необходимых значений.
</p>

<div>
    <?php echo CHtml::link('<i class="icon-file icon-white"></i>&nbsp;Создать', array('useradmin/create'), array('class'=>'btn btn-primary')) ?>
    <!-- -->
    <?php echo CHtml::link('<i class="icon-search icon-white"></i>&nbsp;Расширеный поиск','#',array('class'=>'search-button btn btn-primary')); ?>
</div>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
        'model'=>$model,
    )); ?>
</div>
<!-- search-form -->


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'password',
		'profile',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>



        </div>
    </div>
    </div>
</div>