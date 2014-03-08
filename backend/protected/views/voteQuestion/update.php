<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Изменить голосование</div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">

            <?php $this->renderPartial('_form', array('model'=>$model, 'listStatus'=>$listStatus,)); ?>


        </div>
        </div>
    </div>
</div>