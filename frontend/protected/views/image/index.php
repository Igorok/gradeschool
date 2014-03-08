<?php
    /* @var $this ImageController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs=array(
    	'Изображения',
    );
    $this->pageTitle=$model->'В этом разделе Вы найдете красивые картинки, привлекающие внимание детей с самого раннего возраста.';
    $this->pageMetaDescription = 'В этом разделе Вы найдете красивые картинки, привлекающие внимание детей с самого раннего возраста.';
    $this->pageMetaKeywords = 'Картинки, расскраски, календари, расписания занятий';
?>

<h3>Изображения</h3>
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
         'summaryText' => '<div class="show_report">Всего <b>{count}</b> изображений, с {start} по {end}</div>',
         'template' => "{summary}{pager}{items}{pager}",
    )); 
?>