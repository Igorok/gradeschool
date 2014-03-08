<?php
/* @var $this AudioCategoryController */
/* @var $model AudioCategory */

    $this->breadcrumbs=array(
        'Категории видео'=>array('videocategory/index'),
        $categoryName->name,
    );
    $this->pageTitle=$categoryName->name;
    $this->pageMetaDescription = $categoryName->meta_description;
    $this->pageMetaKeywords = $categoryName->meta_keywords;
    
    echo '<h3>' . $categoryName->name . '</h3>';

    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_video',
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