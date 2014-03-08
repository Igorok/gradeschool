<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?php echo $model->title; ?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">

        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'title',
                'status_id',
            ),
        )); ?>



        </div>
        </div>
    </div>
</div>