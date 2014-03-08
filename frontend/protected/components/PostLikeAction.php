<?php
    /**
    * добавление лайка аякс ссылкой
    */
    class PostLikeAction extends CAction
    {
        public $modelName;

        public function run()
        {
            $model = new $this->modelName;

            if(isset($_POST) && Yii::app()->request->isAjaxRequest)
            {   
                $model->attributes=$_POST;
                // валидация данных в модели
                if($model->validate())
                {
                    // проверяю в базе, лайкал ли юзер статью
                    $modelPostLike = CActiveRecord::model($this->modelName)->findByAttributes(
                        array(
                            'post_id'=>$model->post_id,
                            'user_id'=>$model->user_id
                        )
                    );
                    // если нет то добавляю лайк
                    if($modelPostLike===null){
                        $model->save();
                    }
                    // в противном случае удаляю лайк
                    else {
                        $modelPostLike->delete();
                    }
                    // получаю число лайков для статьи
                    $postLikeCount = CActiveRecord::model($this->modelName)->count(array(
                        'condition'=>'post_id=' . (int)$model->post_id,
                    ));
                    // возвращаю результат
                    echo CJSON::encode((int)$postLikeCount); 
                    Yii::app()->end();
                }
            }
        }
        
    }