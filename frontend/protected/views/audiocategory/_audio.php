<!-- one news-->
<div class="container one_news_content">
    <div class="row">
        <!-- Проверка наличия изображения -->
        <?php if(!empty($data->image_name)): ?>
            <div class="col-md-4">
                <div class="image_case">
                    <a href="<?= $data->url; ?>">
                        <img alt="<?= CHtml::encode($data->title); ?>" src="<?= Yii::app()->request->baseUrl . Yii::app()->params['userAudiosPath'] . CHtml::encode($data->image_name); ?>" />
                    </a>
                </div>
            </div>
            <!-- -->
        <?php endif; ?>
        <!-- конец проверка наличия изображения -->
        <!-- -->
        <div class="col-md-8 news_text">
            <h4>
              <?= CHtml::link(CHtml::encode($data->title), $data->url) ?>
            </h4>
            <!-- -->
            <p>
                <?= CHtml::encode($data->short_description); ?>
            </p>
            <!-- info case -->
            <div class="row news_info_case">
              <!-- -->
              <div class="col-md-8 datetime_case">
                <?= date("Y-m-d", strtotime($data->create_time)); ?>
              </div>
              <!-- -->
              <div class="col-md-4">
                <?= CHtml::link('Смотреть', $data->url, array('class'=>'btn btn-yellow')) ?>
              </div>
              <!-- -->
            </div>
            <!-- end info case -->
        </div>
        <!-- -->
    </div>
</div>
<!-- end one news-->