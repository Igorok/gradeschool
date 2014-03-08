<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">О сайте</div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">
        
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',,'pager' => array(
                'class' => 'CLinkPager',
                'firstPageLabel' => '&lt;&lt;',
                'prevPageLabel' => '&lt;',
                'nextPageLabel' => '&gt;',
                'lastPageLabel' => '&gt;&gt;',
                'maxButtonCount' => '5',
                'header' => false,
            ),
            'ajaxUpdate' => true,
             'summaryText' => '<div class="show_report">Всего <b>{count}</b> изображений, с {start} по {end}</div>',
        )); ?>
        </div>
    </div>
    </div>
</div>