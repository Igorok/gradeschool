<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">
            Администратор <?php echo $model->username; ?>
        </div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">
        
        <h1></h1>

        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'username',
                'password',
                'profile',
            ),
        )); ?>


        </div>
    </div>
    </div>
</div>