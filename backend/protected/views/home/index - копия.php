<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Posts',
);

$this->menu=array(
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h1>Posts</h1>

<div>
	<ul>
	<?php foreach($post_category as $one_post):?>
		<li>
			<?php echo CHtml::link(CHtml::encode($one_post->name), $one_post->url); ?>
		</li>
	<?php endforeach ?>
	</ul>
</div>
<!-- -->
<h1>Image</h1>
<div>
	<ul>
	<?php foreach($image_category as $one_image):?>
		<li>
			<?php echo CHtml::link(CHtml::encode($one_image->name), $one_image->url); ?>
		</li>
	<?php endforeach ?>
	</ul>
</div>
<!-- -->
<h1>Audio</h1>
<div>
	<ul>
	<?php foreach($audio_category as $one_audio):?>
		<li>
			<?php echo CHtml::link(CHtml::encode($one_audio->name), $one_audio->url); ?>
		</li>
	<?php endforeach ?>
	</ul>
</div>
<!-- -->
<h1>Video</h1>
<div>
	<ul>
	<?php foreach($video_category as $one_video):?>
		<li>
			<?php echo CHtml::link(CHtml::encode($one_video->name), $one_video->url); ?>
		</li>
	<?php endforeach ?>
	</ul>
</div>

