<?php
/* @var $this AboutController */
/* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs=array(
    	'О нас',
    );
    $this->pageTitle='О нас';
    $this->pageMetaDescription = 'Начальная школа — познавательно-развлекательный портал для детей, родителей и педагогов';
    $this->pageMetaKeywords = 'О нас';
?>

<h3>О нас</h3>

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
