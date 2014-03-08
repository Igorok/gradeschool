<?php
    /* @var $this VideoController */
    /* @var $model Video */

    $this->breadcrumbs=array(
    	'Категории видео'=>array('videocategory/index'),
    	$model->title,
    );
    $this->pageTitle=$model->title;
    $this->pageMetaDescription = $model->meta_description;
    $this->pageMetaKeywords = $model->meta_keywords;
?>

<div class="container row">
    <div class="col-md-12">
    <h3>
        <?php echo CHtml::encode($model->title); ?>
    </h3>
    <!-- -->
    <div>
        <?php echo $model->link; ?>
    </div>
    <!-- -->
    <p>
        <?php 
            $news_date = ViewHelper::russian_date(strtotime($model->create_time)); 
            echo $news_date['allDate'];
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