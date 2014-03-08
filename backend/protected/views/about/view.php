<?php
    $this->pageTitle=$model->title;
?>

<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?php echo CHtml::encode($model->title); ?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">
        
        

            <div>
            <?php
                if(!empty($model->image_name)){
                    echo '<div class="post_img"><img alt="' . CHtml::encode($model->title) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['imagePath'] . CHtml::encode($model->image_name) . '" /></div>';
                }
            ?>
            </div>
            <p>
                <?php echo CHtml::encode($model->short_description); ?>
            </p>
            <p>
                <?php 
                    echo ViewHelper::replaceBBCode(CHtml::encode($model->full_description));
                ?>
            </p>


        </div>
    </div>
    </div>
</div>