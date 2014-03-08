<?php
	$this->pageTitle='Поиск';
	$this->pageMetaDescription = 'Поиск';
    $this->pageMetaKeywords = 'Поиск';
	$this->breadcrumbs=array(
	'Поиск',
);
?>

<h3>Поиск</h3>

<?php if(Yii::app()->user->hasFlash('search')): ?>

<div class="alert alert-success">
    <?php echo Yii::app()->user->getFlash('search'); ?>
</div>

<?php else: ?>

<p>
    Вы можете использовать поиск по сайту
</p>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'search-form',
    'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Поля со <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($searchFormModel, 'Исправьте, пожалуйста, следующие ошибки:'); ?>

    <div class="clearfix">
        <?php echo $form->labelEx($searchFormModel,'query'); ?>
        <?php echo $form->textField($searchFormModel,'query', array('class'=>'form-control', 'required'=>'required')); ?>
        <?php echo $form->error($searchFormModel,'query'); ?>
    </div>


    <div class=" buttons">
    <?php echo CHtml::submitButton('Поиск', array('class'=>'btn btn-success')); ?>
    <div id="output"></div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>