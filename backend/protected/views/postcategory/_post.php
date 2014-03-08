<?php
/* @var $this PostController */
/* @var $data Post */
?>

<div class="view_post">
	<?php
		if(!empty($data->image_name)){
			echo '<div class="post_img"><img alt="' . CHtml::encode($data->title) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['userPostsPath'] . CHtml::encode($data->image_name) . '" /></div>';
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
            $post_date = ViewHelper::russian_date(strtotime($data->create_time));
            echo $post_date['allDate'];
        ?>
	</p>
	<!-- -->
	<p>
        <span class="blue_color">Автор: </span>
		<?php 
			// получаем запись с именем пользователя
			echo $user_name=$data->user->username;
		?>
	</p>
	<!-- -->
    <p>
        <span class="blue_color">Категория: </span>
		<?php 
			// получаем запись с именем пользователя
			echo $user_name=$data->category->name;
		?>
	</p>
	<!-- -->
</div>