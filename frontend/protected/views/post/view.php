<?php
/* @var $this PostController */
/* @var $model Post */

    $this->breadcrumbs=array(
        'Категории постов'=>array('postcategory/index'),
        $model->title,
    );
    $this->pageTitle=$model->title;
    $this->pageMetaDescription = $model->title;
    $this->pageMetaKeywords = $model->title;
?>

<?php if(!Yii::app()->user->isGuest && Yii::app()->user->id == $model->user_id): ?>
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
<?php endif; ?>

<div class="container row">
    <div class="col-md-12">
    <?php if(!empty($model->image_name)) : ?>
    	<div class="main_post_img">
            <img alt="<?= CHtml::encode($model->title); ?>" src="<?= Yii::app()->request->baseUrl . Yii::app()->params['userPostsPath'] . CHtml::encode($model->image_name);?> " />
        </div>
    <?php endif; ?>
    <h3>
        <?php echo CHtml::encode($model->title); ?>
    </h3>
    <!-- -->
    <p class="blue_color">
        <?php echo CHtml::encode($model->user->username); ?>
        <span> - </span>
        <!-- -->
        <?php 
            $post_date = ViewHelper::russian_date(strtotime($model->create_time)); 
            echo CHtml::encode($post_date['allDate']);
        ?>
    <p>
    <!-- -->
    <p class="italic">
        <?php echo CHtml::encode($model->short_description); ?>
    <p>
    <!-- -->
    <p>
        <?php echo ViewHelper::replaceBBCode(CHtml::encode($model->full_description)); ?>
    <p>
    <!-- -->

    </div>
    

    

    <div class="container allComments">
        <?php if(!empty($postCommentsAll)){
            foreach($postCommentsAll as $oneComment){
                echo '<div class="oneCommentCase"><p><span class="h5">' . CHtml::encode($oneComment->user->username) . ' - ' . $oneComment->create_time . '</span></p>';
                echo CHtml::encode($oneComment->description) . '</div>';
            }
        } ?>
    </div>
    
    
    

    <?php if(!Yii::app()->user->isGuest): ?>
    <!-- -->
    <div class="container row likeCase">
        <!-- likes -->
        <div class="col-md-1 likeUp">
            <?php 
                echo CHtml::ajaxLink('<span class="glyphicon glyphicon-thumbs-up"></span>', array('post/postLike'),
                    array(
                        'type'=>'post',
                        'success'=>'function(data){
                            $(".likeUp").find(".count").html(data)
                        }',
                        'data'=>array(
                            'post_id'=> $model->id,
                            'user_id'=> Yii::app()->user->id,
                        ),
                    ),
                    array(
                        'id'=>'postLikeToggle',
                    ));
            ?>
            <span class="count"><?= CHtml::encode($postLikeCount); ?></span>
        </div>

        <!-- dislikes -->
        <div class="col-md-1 likeDown">
            <?php 
                echo CHtml::ajaxLink('<span class="glyphicon glyphicon-thumbs-down"></span>', array('post/postDislike'),
                    array(
                        'type'=>'post',
                        'success'=>'function(data){
                            $(".likeDown").find(".count").html(data)
                        }',
                        'data'=>array(
                            'post_id'=> $model->id,
                            'user_id'=> Yii::app()->user->id,
                        ),
                    ),
                    array(
                        'id'=>'postDislikeToggle',
                    ));
            ?>
            <span class="count"><?= CHtml::encode($postDislikeCount); ?></span>
        </div>

        <!-- comments -->
        <div class="col-md-3 commentCount">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                <span class="glyphicon glyphicon-comment"></span>
                <span class="count">Комментировать</span>
            </a>
        </div>
    </div>
    <!-- comment form  -->
    <div id="collapseOne" class="panel-collapse collapse">
        <div class="comentForm">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'postCommentsForm',
                'enableAjaxValidation'=>true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                ),
                'action'=>Yii::app()->createUrl('//PostComments/create'),
            )); ?>
                
                <div>
                    <?php echo $form->hiddenField($postCommentsForm,'post_id', array(
                        'value' => $model->id,
                    )); ?>
                </div>

                <div>
                    <?php echo $form->hiddenField($postCommentsForm,'user_id', array(
                        'value' => Yii::app()->user->id,
                    )); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($postCommentsForm,'description'); ?>
                    <?php echo $form->textArea($postCommentsForm,'description', array('class'=>'form-control', 'placeholder'=>'Введите ваше сообщение', 'required'=>'requierd')); ?>
                    <?php echo $form->error($postCommentsForm,'description'); ?>
                </div>
                <!-- buttons -->
                <div class=" buttons">
                    <?php echo CHtml::ajaxSubmitButton('Отправить', '/PostComments/create', array(
                        'class'=>'btn btn-default',
                        'dataType'=>'json',
                        'type' => 'POST',
                        'update' => '#output',
                        'success' => 'function(data) {
                            if (data.indexOf("{")== 0 ) {
                                var json = $.parseJSON(data);

                                $.each(json, function(key, value) {
                                    $("#" + key).addClass("clsError");
                                    $("#" + key + "_em_").show().html(value.toString());
                                });
                            }
                            else{
                                $(".allComments").prepend(
                                    "<div class=\"alert alert-success\"><span class=\"bold\">' . Yii::app()->user->name . ' - ' . date ("H:m:s") . '</span><p>" + data + "</p></div>"
                                );
                                $("#PostComments_description").empty();
                            }
                        }',
                        'error' => 'function(data){
                            alert(data);
                        }'
                    ),
                    array(
                        // Меняем тип элемента на submit, чтобы у пользователей
                        // с отключенным JavaScript всё было хорошо.
                        'type' => 'submit',
                        'class'=>'btn btn-success',
                    )); ?>
                    <div id="output"></div>
                </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>

    <?php else: ?>
        <div class="container row likeCase">
            <!-- likes -->
            <div class="col-md-1 likeUp">
                <span class="glyphicon glyphicon-thumbs-up"></span>
                <span class="count"><?= CHtml::encode($postLikeCount); ?></span>
            </div>

            <!-- dislikes -->
            <div class="col-md-1 likeDown">
                <span class="glyphicon glyphicon-thumbs-down"></span>
                <span class="count"><?= CHtml::encode($postDislikeCount); ?></span>
            </div>

            <!-- comments -->
            <div class="col-md-10 commentCount">
                <span class="count">Войдите чтобы оценить или прокомментировать статью</span>
            </div>
        </div>
    <?php endif; ?>


</div>