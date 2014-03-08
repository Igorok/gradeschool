<?php
    $this->pageTitle='Произошла ошибка ' . $code;
    $this->pageMetaDescription = 'Произошла ошибка ' . $code;
    $this->pageMetaKeywords = 'Произошла ошибка ' . $code;
    $this->breadcrumbs=array(
    	'Ошибка ' . $code,
    );
?>

<h3>Произошла ошибка <?php echo $code; ?></h3>
<div class="alert alert-danger">
    <?= CHtml::encode($message); ?>
</div>