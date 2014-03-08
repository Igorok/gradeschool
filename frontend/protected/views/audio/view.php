<?php
    /* @var $this AudioController */
    /* @var $model Audio */

    $this->breadcrumbs=array(
    	'Категории аудиозаписей'=>array('audiocategory/index'),
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
            <img alt="<?= CHtml::encode($model->title); ?>" src="<?= Yii::app()->request->baseUrl . Yii::app()->params['userAudiosPath'] . CHtml::encode($model->image_name);?> " />
        </div>
    <?php endif; ?>

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