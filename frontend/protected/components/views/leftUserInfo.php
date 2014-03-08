<div class="userLeftInfo">
    <?php if(Yii::app()->user->isGuest): ?>
      <!-- registration -->
      <?= '<p>' . CHtml::link('<span class="glyphicon glyphicon-edit"></span>&nbsp; Регистрация', array('site/registration')) . '</p>'; ?>
      <!-- login -->
      <?= '<p>' . CHtml::link('<span class="glyphicon glyphicon-log-in"></span>&nbsp; Войти', array('site/login')) . '</p>'; ?>
    <?php else:?>
      <div class="userLeftLogin">
        <!-- -->
        <div class="image_case"><img src="
        <?php
          if(!empty($userModel->image_thumb)) {
            echo Yii::app()->request->baseUrl . Yii::app()->params['userThumbPath'] . $userModel->image_thumb;
          }
          else {
            echo Yii::app()->request->baseUrl . Yii::app()->params['userThumbPath'] . 'none_image.jpg';
          }
        ?>
        " alt="<?= Yii::app()->user->name; ?>"></div>
        <!-- -->
        <!-- account -->
        <?= '<p>' . CHtml::link('<span class="glyphicon glyphicon-user"></span>&nbsp; Личный кабинет (' . Yii::app()->user->name . ')', array('user/account')) . '</p>'; ?>
        <!-- logout -->
        <?= '<p>' . CHtml::link('<span class="glyphicon glyphicon-log-out"></span>&nbsp; Выйти', array('site/logout')) . '</p>'; ?>
        <!-- -->
      </div>
    <?php endif; ?>
</div>