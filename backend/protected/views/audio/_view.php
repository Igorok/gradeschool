<?php
/* @var $this AudioController */
/* @var $data Audio */
?>

<div class="view_post">
	<?php
		if(!empty($data->image_name)){
			echo '<div class="post_img"><img alt="' . CHtml::encode($data->title) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['userAudiosPath'] . CHtml::encode($data->image_name) . '" /></div>';
		}
	?>
	<!-- -->
	<h3>
        <?= CHtml::encode($data->title); ?>
	</h3>
	<!-- -->
	<p>
		<?php echo CHtml::encode($data->short_description); ?>
	</p>
	<!-- -->
	<p class="blue_color">
		<?php 
            echo russian_date(strtotime($data->create_time));
            echo '&nbsp;' . CHtml::encode($data->category->name);
        ?>
	</p>
	<!-- -->
</div>