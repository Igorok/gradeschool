<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?php echo CHtml::encode($model->title); ?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">
        
        <?php
            if(!empty($model->image_name)){
                echo '<div class="post_img"><img alt="' . CHtml::encode($model->title) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['userNewsPath'] . CHtml::encode($model->image_name) . '" /></div>';
            }
        ?>
        <!-- -->
        <p>
            <?php 
                $news_date = ViewHelper::russian_date(strtotime($model->create_time));
                echo CHtml::encode($news_date['allDate']);
            ?>
        <p>
        <!-- -->
        <p>
            <?php echo CHtml::encode($model->short_description); ?>
        <p>
        <!-- -->
        <p>
            <?php echo ViewHelper::replaceBBCode(CHtml::encode($model->full_description)); ?>
        <p>



       </div>
    </div>
    </div>
</div>