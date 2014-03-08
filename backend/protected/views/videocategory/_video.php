<div class="view_post">
	<?php
		if(!empty($data->image_name)){
			echo '<div class="post_img"><img alt="' . CHtml::encode($data->title) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['userVideosPath'] . CHtml::encode($data->image_name) . '" /></div>';
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
	<p>
		<?php 
             $video_date = ViewHelper::russian_date(strtotime($data->create_time));
             echo $video_date['allDate'];
        ?>
	</p>
	<!-- -->
</div>