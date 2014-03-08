<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?php echo $model->title; ?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">

        <!-- -->
        <?php
            if(!empty($model->image_name)){
                echo '<div class="post_img"><img alt="' . CHtml::encode($model->title) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['userImagesPath'] . CHtml::encode($model->image_name) . '" /></div>';
            }
        ?>
        <!-- -->

        <p class="italic">
            <?php echo CHtml::encode($model->short_description); ?>
        </p>
        <!-- -->
        <p>
            <?php echo CHtml::encode($model->full_description); ?>
        </p>
        <!-- -->
        <p>
            <?php 
                $image_date = ViewHelper::russian_date(strtotime($model->create_time)); 
                echo $image_date['allDate'] . ' - ';
                echo CHtml::link('Скачать', $model->link, array('target'=>'_blank')); 
            
            ?>
        </p>



        </div>
    </div>
    </div>
</div>


















