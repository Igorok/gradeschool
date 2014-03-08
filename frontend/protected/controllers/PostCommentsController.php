<?php

class PostCommentsController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + create', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Добавление нового комментария
	 */
	public function actionCreate()
	{
		$model=new PostComments;
		
        if(isset($_POST['PostComments']) && Yii::app()->request->isAjaxRequest)
        {
            $model->attributes=$_POST['PostComments'];

            if($model->validate())
            {
                if($model->save()){
                    echo CJSON::encode($model->description);
                    Yii::app()->end();
                }
            }
            else {
                echo CJSON::encode(CActiveForm::validate($model));
                Yii::app()->end();
            }
        }
	}
}
