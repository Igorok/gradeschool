<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?php echo $model->title; ?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">


<div class="post_page">
<?php
	if(!empty($model->image_name)){
		echo '<div class="post_img"><img alt="' . CHtml::encode($model->title) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['userAudiosPath'] . CHtml::encode($model->image_name) . '" /></div>';
	}
?>
<h1>
    <?php echo CHtml::encode($model->title); ?>
</h1>
<!-- -->
<div>
    <?php echo $model->link; ?>
</div>
<!-- -->
<p>
    <?php 
        $audio_date = ViewHelper::russian_date(strtotime($model->create_time)); 
        echo $audio_date['allDate'];
    ?>
</p>
<!-- -->
<p class="italic">
    <?php echo CHtml::encode($model->short_description); ?>
</p>
<!-- -->
<p>
    <?php echo CHtml::encode($model->full_description); ?>
</p>
<!-- -->
</div>



        </div>
    </div>
    </div>
</div>