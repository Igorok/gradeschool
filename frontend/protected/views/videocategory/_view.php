<?php
/* @var $this VideoCategoryController */
/* @var $data VideoCategory */
?>

<div class="view">
    <h3>
        <?php echo 
            CHtml::link(CHtml::encode($data->name), $data->url); 
        ?>
    </h3>


</div>