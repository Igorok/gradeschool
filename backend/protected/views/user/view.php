<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?php echo $model->username; ?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">

        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'username',
                'password',
                'email',
                'profile',
                'fio',
                'about',
                'dob',
                'profession',
                'image_name',
                'user_status',
            ),
        )); ?>

        </div>
    </div>
    </div>
</div>