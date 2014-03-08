<?php
    /* @var $this VideoCategoryController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs=array(
    	'Категории видео',
    );
    $this->pageTitle = 'Добрые мультики и фильмы для детей и всей семьи, которые учат быть дружными и отзывчивым';
    $this->pageMetaDescription = 'Добрые мультики и фильмы для детей и всей семьи, которые учат быть дружными и отзывчивым';
    $this->pageMetaKeywords = 'Добрые мультики и фильмы для детей и всей семьи';
?>

<h3>Категории видео</h3>

<?php 
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
         'summaryText' => '<div class="show_report">Всего <b>{count}</b> видео, с {start} по {end}</div>',
         'template' => "{summary}{pager}{items}{pager}",
    )); 
?>
