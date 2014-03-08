<?php
/* @var $this VideoCategoryController */
/* @var $data VideoCategory */
?>

<div class="view">
    <h2>
        <?php echo 
            CHtml::link(CHtml::encode($data->name), $data->url); 
        ?>
    </h2>


</div>