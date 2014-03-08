<?php
    $this->breadcrumbs=array(
        'Личный кабинет'=>array('user/account'),
        'Мои посты',
    );
    $this->pageTitle='Мои посты';
    
    $this->pageMetaDescription = 'Мои посты';
    $this->pageMetaKeywords = 'Мои посты';
?>
<div class="container row">
    <div class="col-md-12">
        <?php
            $this->widget('zii.widgets.CMenu',array(
                'htmlOptions'=>array('class'=>'nav nav-pills userMenu'),
                'items'=>array(
                    array(
                        'template' => '{menu} <span class="glyphicon glyphicon-user"></span>',
                        'label'=>'Личный кабинет', 
                        'url'=>array('user/account'),
                    ),
                    array(
                        'template' => '{menu} <span class="glyphicon glyphicon-edit"></span>',
                        'label'=>'Редактировать профиль', 
                        'url'=>array('user/update'),
                    ),
                    array(
                        'template' => '{menu} <span class="glyphicon glyphicon-file"></span>',
                        'label'=>'Создать пост', 
                        'url'=>array('post/create'),
                    ),
                    array(
                        'template' => '{menu} <span class="glyphicon glyphicon-folder-open"></span>',
                        'label'=>'Мои посты', 
                        'url'=>array('post/mypost'),
                    ),
                )
            ));
        ?>
    </div>
</div>
<h3>Мои посты</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
    'emptyText'=>'Ни одного поста не найдено',
    'emptyTagName'=>'div class="alert alert-warning"',
	'itemView'=>'_post',
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