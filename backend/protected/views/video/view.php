<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?php echo $model->title; ?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">



<h1><?php echo $model->title; ?></h1>
<div class="view_post">
	<?php
		if(!empty($model->image_name)){
			echo '<div class="post_img"><img alt="' . CHtml::encode($model->title) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['userVideosPath'] . CHtml::encode($model->image_name) . '" /></div>';
		}
	?>
	<!-- -->
	<h3>
        <?= CHtml::encode($model->title); ?>
	</h3>
	<!-- -->
    <div>
        <?php echo $model->link; ?>
    </div>
    <!-- -->
	<p>
		<?php echo CHtml::encode($model->short_description); ?>
	</p>
    <!-- -->
    <p>
		<?php echo ViewHelper::replaceBBCode(CHtml::encode($model->full_description)); ?>
	</p>
	<!-- -->
	<p class="blue_color">
		<?php 
            echo CHtml::encode($model->category->name) . '&nbsp;';
            $video_date = ViewHelper::russian_date(strtotime($model->create_time));
            echo $video_date['allDate'];
        ?>
	</p>
	<!-- -->
</div>




        </div>
    </div>
    </div>
</div>