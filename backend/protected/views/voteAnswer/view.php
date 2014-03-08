<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Ответ <?php echo $model->question->title; ?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">


        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'question_id',
                'status_id',
                'description',
                'answer_count',
            ),
        )); ?>


        </div>
        </div>
    </div>
</div>