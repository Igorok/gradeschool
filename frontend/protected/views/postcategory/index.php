<?php
    /* @var $this PostCategoryController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs=array(
    	'Категории постов',
    );
    $this->pageTitle = 'Категории постов';
    $this->pageMetaDescription = 'Категории постов';
    $this->pageMetaKeywords = 'Категории постов';
    
?>

<h3>Категории постов</h3>

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
         'summaryText' => '<div class="show_report">Всего <b>{count}</b> постов, с {start} по {end}</div>',
         'template' => "{summary}{pager}{items}{pager}",
    )); 
?>
