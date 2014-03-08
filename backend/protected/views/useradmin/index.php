<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Администраторы</div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">

            <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_view',
            )); ?>


        </div>
    </div>
    </div>
</div>