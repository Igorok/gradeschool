<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Личный кабинет'=>array('account'),
	$model->username,
);

$this->pageTitle=$model->username;

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
<h3>Изменить профиль - <?php echo $model->username; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>