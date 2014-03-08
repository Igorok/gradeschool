<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view_post clearfix">
    <div class="post_img">
	<?php
		if(!empty($data->image_thumb)){
			echo '<img alt="' . CHtml::encode($data->username) . '" src="' . Yii::app()->request->baseUrl . Yii::app()->params['userThumbPath'] . CHtml::encode($data->image_thumb) . '" />';
		}
	?>
    </div>
	<!-- post content -->
    <div class="short_post">
    
        <h4>
            <?php echo CHtml::link(CHtml::encode($data->username), $data->url) ?>
        </h4>
        <!-- -->
        <p>
            <?php echo CHtml::encode($data->about); ?>
        </p>
        <!-- -->
        <p>
            <span class="label label-info"> ФИО: </span>
            <?php 
                echo $data->fio . ';';
            ?>
        </p>
        <p>
            <span class="label label-info"> Email: </span>
            <?php 
                echo $data->email . ';';
            ?>
        </p>
        <p>
            <span class="label label-info"> Профессия: </span>
            <?php 
                echo $data->profession . ';';
            ?>
        </p>
        
        
        <p>
            <span class="label label-info"> Дата рождения: </span>
            <?php 
                $create_date = ViewHelper::russian_date(strtotime($data->create_time)); 
                echo $create_date['allDate'] . ';';
            ?>
        </p>
        <p>
            <span class="label label-info"> Дата регистрации: </span>
            <?php 
                $birth_date = ViewHelper::russian_date(strtotime($data->dob)); 
                echo $birth_date['allDate'] . ';';
            ?>
        </p>
    </div>
	<!-- post button-->
    <div class="button_post">
        <p>
        <!-- edit -->
        <?php echo CHtml::link('<i class="icon-edit icon-white"></i>&nbsp;Редактировать', array('user/update?id=' . $data->id), array('class'=>'btn btn-primary')); ?>
        </p><p>
        <!-- -->
        <?php echo CHtml::linkButton('<i class="icon-remove icon-white"></i>&nbsp;Удалить',array(
           'class' => 'btn btn-danger',
           'submit'=>array('user/delete','id'=>$data->id),
           'confirm'=>"Вы уверены, что хотите удалить запись?",           
        )); ?>
        </p>
        
        
    </div>
    <!-- end button -->
    
    
</div>

