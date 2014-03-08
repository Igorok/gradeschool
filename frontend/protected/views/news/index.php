<?php
    /* @var $this VideoController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs=array(
    	'Новости',
    );
    $this->pageTitle='Новости сайта';
    $this->pageMetaDescription = 'Новости сайта';
    $this->pageMetaKeywords = 'Новости сайта';


    echo '<h3>Новости</h3>';
    $this->widget('zii.widgets.CListView', array(
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
         'summaryText' => '<div class="show_report">Всего <b>{count}</b> новостей, с {start} по {end}</div>',
         'template' => "{summary}{pager}{items}{pager}",
)); 