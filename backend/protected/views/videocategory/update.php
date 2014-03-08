<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Изменить - <?php echo $model->name; ?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
    </div>
    </div>
</div>