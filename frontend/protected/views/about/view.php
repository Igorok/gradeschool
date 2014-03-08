<?php
/* @var $this AboutController */
/* @var $model About */

    $this->breadcrumbs=array(
    	'О нас'=>array('index'),
    	$model->title,
    );
    $this->pageTitle=$model->title;
    $this->pageMetaDescription = $model->meta_description;
    $this->pageMetaKeywords = $model->meta_keywords;

?>
<div class="container row">
    <div class="col-md-12">
    <?php if(!empty($model->image_name)) : ?>
        <div class="main_post_img">
            <img alt="<?= CHtml::encode($model->title); ?>" src="<?= Yii::app()->request->baseUrl . Yii::app()->params['imagePath'] . CHtml::encode($model->image_name);?> " />
        </div>
    <?php endif; ?>
    <h3>
        <?php echo CHtml::encode($model->title); ?>
    </h3>
    <!-- -->
    <p class="italic">
        <?php echo CHtml::encode($model->short_description); ?>
    <p>
    <!-- -->
    <p>
        <?php echo ViewHelper::replaceBBCode($model->full_description); ?>
    <p>
    <!-- -->

    </div>
</div>