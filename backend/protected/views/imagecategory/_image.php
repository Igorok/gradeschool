<div class="view">
    <?php
		if(!empty($data->image_name)){
			echo '<div class="post_img"><img alt="' . CHtml::encode($data->title) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['userImagesPath'] . CHtml::encode($data->image_name) . '" /></div>';
		}
	?>
    <!-- -->
    <h2>
        <?= CHtml::encode($data->title); ?>
    </h2>
    <!-- -->
    <p>
        <?php echo CHtml::encode($data->short_description); ?>
    </p>
</div>