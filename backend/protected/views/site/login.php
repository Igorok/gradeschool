<?php
$this->pageTitle=Yii::app()->name . ' - Вторгайтесь';
?>
<div class="login_form_page">
    <h2 class="form-signin-heading">Admin Panel</h2>

    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
    )); ?>

        <p class="note">Поля со <span class="required">*</span> обязательны</p>

        <div class="row">
            <p>Логин <span class="required">*</span></p>
            <?php echo $form->textField($model,'username'); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>

        <div class="row">
            <p>Пароль <span class="required">*</span></p>
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>

        <div class="row rememberMe">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?php echo $form->error($model,'rememberMe'); ?>
            <label>Запомнить меня</label>
        </div>

        <div class="row submit">
            <?php echo CHtml::submitButton('Вторгайтесь', array('class'=>'btn btn-primary')); ?>
        </div>
        <div id="output"></div>
    <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>
