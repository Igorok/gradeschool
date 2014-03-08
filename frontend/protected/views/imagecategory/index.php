<?php
    /* @var $this ImageCategoryController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs=array(
    	'Категории изображений',
    );
    $this->pageTitle='В этом разделе Вы найдете красивые картинки, привлекающие внимание детей с самого раннего возраста.';
    $this->pageMetaDescription = 'В этом разделе Вы найдете красивые картинки, привлекающие внимание детей с самого раннего возраста.';
    $this->pageMetaKeywords = 'Картинки, расскраски, календари, расписания занятий';
?>

<h3>Категории изображений</h3>

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
         'summaryText' => '<div class="show_report">Всего <b>{count}</b> категорий, с {start} по {end}</div>',
         'template' => "{summary}{pager}{items}{pager}",
    )); 

?>
