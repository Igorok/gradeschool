<?php
/* @var $this AudioCategoryController */
/* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs=array(
    	'Категории аудио',
    );
    $this->pageTitle='Категории аудио';
    $this->pageMetaDescription = 'Любимые песни детей из мультфильмов. Аудио сказки и уроки для детей';
    $this->pageMetaKeywords = 'Аудио уроки, аудио сказки, детские песни';
?>

<h3>Категории аудио</h3>

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
         'summaryText' => '<div class="show_report">Всего <b>{count}</b> аудиозаписей, с {start} по {end}</div>',
         'template' => "{summary}{pager}{items}{pager}",
    ));
?>
