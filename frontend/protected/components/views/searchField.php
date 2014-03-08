<!--
<div class="input-group searchGroup">
  <form action="<?= Yii::app()->request->baseUrl; ?>/site/search/" method="post">
      <input type="text" class="form-control" required placeholder="Поиск" id="searchQuery" name="searchQuery" />
      <span class="input-group-btn">
        <button class="btn btn-yellow" type="submit">
            <span class="glyphicon glyphicon-search"></span>
        </button>
      </span>
  </form>
</div>
<!-- -->


<div class="input-group searchGroup">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'search-form',
    'enableAjaxValidation'=>false,
    'action'=>Yii::app()->createUrl('//site/search'),
    )); ?>

    <!-- 
    <?php echo $form->labelEx($searchFormModel,'query'); ?>
    -->
    <?php echo $form->textField($searchFormModel,'query', array('class'=>'form-control', 'placeholder'=>'Поиск', 'required'=>'required')); ?>
    <?php echo $form->error($searchFormModel,'query'); ?>
    
    <!-- 
    <?php echo CHtml::submitButton('Поиск', array('class'=>'btn btn-yellow')); ?>
    -->
    
    <span class="input-group-btn">
        <button class="btn btn-yellow" type="submit">
            <span class="glyphicon glyphicon-search"></span>
        </button>
      </span>

<?php $this->endWidget(); ?>
</div>
