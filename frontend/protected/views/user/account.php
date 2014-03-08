<?php
    $this->pageTitle='Личный кабинет ' . CHtml::encode($model->username);
    $this->breadcrumbs=array(
        'Личный кабинет',
    );
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
<!-- -->
<div class="container row">
    
    <div class="col-md-6">
        <?php if (!empty($model->image_name)): ?>
            <div class="user_photo">
            <img src="<?= CHtml::encode(Yii::app()->request->baseUrl . Yii::app()->params['userImagePath'] . $model->image_name); ?>" alt="" />
            </div>
        <?php else: ?>
            <p>Вы можете загрузить аватар</p>
        <?php endif; ?>
    </div>
    
    <!-- -->
    <div class="col-md-6">
        <!-- фио -->
        <div class="ud_str">
        <?php if (!empty($model->fio)): ?>
            <p >
            <span class="label label-primary"><?= CHtml::encode($model->getAttributeLabel('fio')); ?>:</span></p>
            <p><?= CHtml::encode($model->fio); ?></p>
        <?php else: ?>
            <p>Вы можете указать имя</p>
        <?php endif; ?>
        
        </div>
        <!-- дата рождения -->
        <div class="ud_str">
        <?php if (!empty($model->dob)): ?>
            <p>
            <span class="label label-primary"><?= CHtml::encode($model->getAttributeLabel('dob')); ?>:</span></p>
            <?php
                $dob_date=ViewHelper::russian_date(strtotime($model->dob));
                echo '<p>' . CHtml::encode($dob_date['allDate']) . '</p>';
            ?>
        <?php else: ?>
            <p>Вы можете указать дату рождения</p>
        <?php endif; ?>
        </div>
        <!-- логин -->
        <div class="ud_str">
        <p>
            <span class="label label-primary"><?= CHtml::encode($model->getAttributeLabel('username')); ?>: </span></p>
            <p><?= CHtml::encode($model->username); ?></p>
        </div>
        <!-- емайл -->
        <div class="ud_str">
        <p>
            <span class="label label-primary"><?= CHtml::encode($model->getAttributeLabel('email')); ?>:</span></p>
            <p><?= CHtml::encode($model->email); ?></p>
        </div>
        <!-- профессия -->
        <div class="ud_str">
        <?php if (!empty($model->profession)): ?>
                <p><span class="label label-primary"><?= CHtml::encode($model->getAttributeLabel('profession')); ?> :</span></p>
                <p><?= CHtml::encode($model->profession); ?></p>
        <?php else: ?>
            <p>Вы можете указать профессию</p>
        <?php endif; ?>
        </div>
    </div>
</div>

<div class="container row">
    <div class="col-md-12">
    <!-- о себе -->
    <p>
    <span class="label label-primary"><?= CHtml::encode($model->getAttributeLabel('about'));?>:</span></p>
    <?php if (!empty($model->about)): ?>
        <p><?= CHtml::encode($model->about); ?> </p>
    <?php else:?>
        <p>Вы можете написать несколько строк о себе</p>
    <?php endif; ?>
    </div>
</div>


















