<!-- -->
<div class="row last_news">
  <div class="col-md-12">
    <!-- -->
    <p class="news_headline">    
		<?= CHtml::link('Последние новости', array('news/index')); ?>
    </p>
    <!-- one news -->
    <?php foreach($someNews as $one_news):?>
    <div class="one_news clearfix">
      <!-- проверка картинки -->
		<?php 
			if(!empty($one_news->image_name)){
				echo '<div class="image_case"><a href="' . $one_news->url . '"><img src="' . Yii::app()->request->baseUrl . Yii::app()->params['userNewsPath'] . CHtml::encode($one_news->image_name) . '" alt="' . CHtml::encode($one_news->title) . '" /></a></div>';
			}		
		?>
      <!-- -->
      <div class="col-md-offset-4 col-md-8 ">
        <p>
          <?= CHtml::encode($one_news->title); ?>
        </p>
        <p>
            <?= CHtml::link('Подробнее', $one_news->url, array('class'=>'btn btn-yellow')); ?>
        </p>
        
      </div>
    </div>
	<?php endforeach ?>
    <!-- end menu-->
   </div>
  <!-- -->
</div>
