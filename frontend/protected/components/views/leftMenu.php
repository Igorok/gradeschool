<div class="row">
<?php 
	$this->widget('zii.widgets.CMenu',array(
		'htmlOptions'=>array('class'=>'leftMenu'),
		'items'=>array(
			array(
				'template' => '<div class="menuMainLink clearfix"><span class="glyphicon glyphicon-home"></span>{menu}</span></div>',
				'label'=>'Главная', 
				'url'=>array('site/index'),
			),
			array(
				'template' => '<div class="menuMainLink clearfix"><span class="glyphicon glyphicon-pencil"></span>{menu}<span class="arrowCase"><span class="glyphicon glyphicon-chevron-down"></span><span class="glyphicon glyphicon-chevron-up"></span></span></div>',
				'label'=>'Посты', 
				'url'=>array('postcategory/index'),
				'items'=>$itemPost,
				'active'=> (strcasecmp(Yii::app()->controller->id, 'postcategory') === 0) ? true : false,
			
			),
			array(
				'template' => '<div class="menuMainLink clearfix"><span class="glyphicon glyphicon-picture"></span>{menu}<span class="arrowCase"><span class="glyphicon glyphicon-chevron-down"></span><span class="glyphicon glyphicon-chevron-up"></span></span></div>',
				'label'=>'Картинки', 
				'url'=>array('imagecategory/index'),
				'items'=>$itemImage,
				'active'=> (strcasecmp(Yii::app()->controller->id, 'imagecategory') === 0) ? true : false,
			),
			array(
				'template' => '<div class="menuMainLink clearfix"><span class="glyphicon glyphicon-headphones"></span>{menu}<span class="arrowCase"><span class="glyphicon glyphicon-chevron-down"></span><span class="glyphicon glyphicon-chevron-up"></span></span></div>',
				'label'=>'Аудио', 
				'url'=>array('audiocategory/index'),
				'items'=>$itemAudio,
				'active'=> (strcasecmp(Yii::app()->controller->id, 'audiocategory') === 0) ? true : false,
			),
			array(
				'template' => '<div class="menuMainLink clearfix"><span class="glyphicon glyphicon-facetime-video"></span>{menu}<span class="arrowCase"><span class="glyphicon glyphicon-chevron-down"></span><span class="glyphicon glyphicon-chevron-up"></span></span></div>',
				'label'=>'Видео', 
				'url'=>array('videocategory/index'),
				'items'=>$itemVideo,
				'active'=> (strcasecmp(Yii::app()->controller->id, 'videocategory') === 0) ? true : false,
			),
		),
	));
?>
</div>