<?php
	$this->pageTitle='Результаты поиска';
	$this->pageMetaDescription = 'Результаты поиска';
    $this->pageMetaKeywords = 'Результаты поиска';
	$this->breadcrumbs=array(
	'Результаты поиска',
);
  //var_dump($dataProvider);exit;
?>

<h3>Результаты поиска:</h3>
<?php 
  $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'oneSearch',
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
     'summaryText' => '<div class="show_report">Всего <b>{count}</b> результатов, с {start} по {end}</div>',
     'template' => "{summary}{pager}{items}{pager}",
  ));
?>