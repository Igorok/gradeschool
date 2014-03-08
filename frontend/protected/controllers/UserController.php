<?php

class UserController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view', 'update', 'account'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    // registration
	public function actionUpdate()
	{
        $model=$this->loadModel(Yii::app()->user->id);
        $model->scenario = 'check_update';

        
            if(isset($_POST['User']))
            {
                // получаем имя старого файла
                $oldAvatar = $model->image_name;
                $oldThumb = $model->image_thumb;
                $oldDob = $model->dob;
            
                $model->attributes=$_POST['User']; //Заполнить модель данными присланными пользователем
                // берем файл из папки превьюшек
                $file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['previewPath'] . $model->image_name; 
                if($model->validate()){
                    // date of birth
                    if(!empty($model->dob)){
                        $model->dob = ViewHelper::dateGen($model->dob);
                    }
                    else {
                        $model->dob = $oldDob;
                    }
                    //проверяю если выбрана картинка image_name то
                    if (!empty($model->image_name)  && $model->image_name != $oldAvatar ){
                        $model->image_thumb = $model->username . '_thumb_' . $model->image_name;
                        $model->image_name = $model->username . '_photo_' . $model->image_name;                        
                        //Используем функции расширения CImageHandler;
                        $ih = new CImageHandler(); //Инициализация
                        Yii::app()->ih 
                        ->load($file) //Загрузка оригинала картинки
                        ->thumb('150', '150') //Создание превьюшки шириной 200px
                        ->save($_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['userThumbPath'] . $model->image_thumb) //Сохранение превьюшки в папку thumbs
                        ->reload()//Снова загрузка оригинала картинки
                        ->thumb('800', '800') //Создание превьюшки размером 800px
                        ->save($_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['userImagePath'] . $model->image_name);  //Сохранение большой картинки в папку
                    }
                    else {
                        $model->image_thumb = $oldThumb;
                        $model->image_name = $oldAvatar;
                    }
                }
                if($model->save()){
                    $this->redirect(array('site/index'));
                }
                
            }

            $this->render('update',array(
                'model'=>$model,
            ));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	//Аккаунт
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAccount()
	{
		$id = Yii::app()->user->id;
        $model = $this->loadModel($id);
		//echo(Yii::app()->user->name);exit;
		$this->render('account',array(
			'model'=>$model,
		));
	}
	
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
}
