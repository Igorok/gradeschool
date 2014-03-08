<div class="row-fluid">
    <div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Посты</div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">
        
        <div class="index_post">

        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
            'pager' => array(
                'class' => 'CLinkPager',
                'firstPageLabel' => '&lt;&lt;',
                'prevPageLabel' => '&lt;',
                'nextPageLabel' => '&gt;',
                'lastPageLabel' => '&gt;&gt;',
                'maxButtonCount' => '5',
                'header' => false,
            ),
            'ajaxUpdate' => true,
             'summaryText' => '<div class="show_report">Всего <b>{count}</b> постов, с {start} по {end}</div>',
             'template' => "{summary}{pager}{items}{pager}",
             
        )); ?>

        </div>
        
        </div>
    </div>
    </div>
</div>