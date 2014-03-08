<?php
/* @var $this PostController */
/* @var $data Post */
?>

<div class="view_post clearfix">
    <div class="post_img">
	<?php
		if(!empty($data->image_name)){
			echo '<img alt="' . CHtml::encode($data->title) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['userPostsPath'] . CHtml::encode($data->image_name) . '" />';
		}
	?>
    </div>
	<!-- post content -->
    <div class="short_post">
        <h4>
            <?= CHtml::encode($data->title) ?>
        </h4>
        <!-- -->
        <p>
            <?php echo CHtml::encode($data->short_description); ?>
        </p>
        <!-- -->
        <p>
            <span class="label label-info"> Автор: </span>
            <?php 
                // получаем запись с именем пользователя
                echo $data->user->username . ';';
            ?>
        </p><p>
            <span class="label label-info"> Категория: </span>
            <?php 
                // получаем запись с именем пользователя
                echo $data->category->name . ';';
            ?>
        </p><p>
            <span class="label label-info"> Дата: </span>
            <?php 
                $post_date = ViewHelper::russian_date(strtotime($data->create_time)); 
                echo $post_date['allDate'] . ';';
            ?>
        </p><p>
            <span class="label label-info"> Статус: </span>
            <?php 
                echo $data->status->title . ';';
            ?>
        </p>
    </div>
	<!-- post button-->
    <div class="button_post">
        <p>
        <!-- edit -->
        <?php echo CHtml::link('<i class="icon-edit icon-white"></i>&nbsp;Редактировать', array('post/update', 'id' => $data->id), array('class'=>'btn btn-primary')); ?>
        </p><p>
        <!-- -->
        <?php echo CHtml::linkButton('<i class="icon-remove icon-white"></i>&nbsp;Удалить',array(
           'class' => 'btn btn-danger',
           'submit'=>array('post/delete','id'=>$data->id),
           'confirm'=>"Вы уверены, что хотите удалить запись?",           
        )); ?>
        </p>
        
        
    </div>
    <!-- end button -->
    
    
</div>