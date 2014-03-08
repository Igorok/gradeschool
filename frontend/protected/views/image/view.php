<?php
    /* @var $this ImageController */
    /* @var $model Image */

    $this->breadcrumbs=array(
    	'Категории изображений'=>array('imagecategory/index'),
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
            <img alt="<?= CHtml::encode($model->title); ?>" src="<?= Yii::app()->request->baseUrl . Yii::app()->params['userImagesPath'] . CHtml::encode($model->image_name);?> " />
        </div>
    <?php endif; ?>
    <h3>
        <?php echo CHtml::encode($model->title); ?>
    </h3>
    <!-- -->
    <p>
        <?php 
        $image_date = ViewHelper::russian_date(strtotime($model->create_time)); 
        echo 'Загружено&nbsp;' . $image_date['allDate'] . '&nbsp;-&nbsp;';
        echo CHtml::link('Скачать', $model->link, array('target'=>'_blank')); 
     ?>
    <p>
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


















