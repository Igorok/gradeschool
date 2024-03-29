<?php

class NewsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
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
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new News;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
            $model->attributes=$_POST['News'];
            
			// получаем данные о загруженном файле
			$model->image_name=CUploadedFile::getInstance($model,'image_name');
			// если модель прошла валидацию 
			if($model->validate())
			{   
                if(!empty($model->image_name)){
                    // данные файла
                    $sourcePath = pathinfo($model->image_name->getName());
                    // новое имя для файла
                    $imageName = 'news_' . time().'.'. $sourcePath['extension'];
                    
                    //Переменной $file присвоить путь, куда сохранится картинка без изменений, параметры тянутся из конфига
                    $file = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->getBaseUrl() . Yii::app()->params['userNewsPath'] .$imageName;
                    $model->image_name->saveAs($file);
                    $model->image_name=$imageName;
                    //Используем функции расширения CImageHandler;
                    $ih = new CImageHandler(); //Инициализация
                    Yii::app()->ih 
                    ->load($file) //Загрузка оригинала картинки
                    ->thumb('800', '800') //Создание превьюшки шириной 800px по длинной стороне
                    ->save($_SERVER['DOCUMENT_ROOT'] . Yii::app()->getBaseUrl() . Yii::app()->params['userNewsPath'] . $imageName); //перезапись уже ужатой картинкой
					
                }
				if($model->save()){
					$this->redirect(array('view','id'=>$model->id));
				}
            }
			
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{   
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			// получаем имя старого файла
            $oldfilename = $model->image_name; 
			$model->attributes=$_POST['News'];
            
			// получаем данные о загруженном файле если файл выбран
            if(!empty($model->image_name)) {
                $model->image_name=CUploadedFile::getInstance($model,'image_name');
            }			
            
			// если модель прошла валидацию 
			if($model->validate())
			{
                if(!empty($model->image_name)){
                    // данные файла
                    $sourcePath = pathinfo($model->image_name->getName());
                    // новое имя для файла
                    $imageName = 'news_' . time().'.'. $sourcePath['extension'];
                    //Переменной $file присвоить путь, куда сохранится картинка без изменений, параметры тянутся из конфига
                    $file = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->getBaseUrl() . Yii::app()->params['userNewsPath'] .$imageName;
                    $model->image_name->saveAs($file);
                    $model->image_name=$imageName;
                    //Используем функции расширения CImageHandler;
                    $ih = new CImageHandler(); //Инициализация
                    Yii::app()->ih 
                    ->load($file) //Загрузка оригинала картинки
                    ->thumb('800', '800') //Создание превьюшки шириной 800px по длинной стороне
                    ->save($_SERVER['DOCUMENT_ROOT'] . Yii::app()->getBaseUrl() . Yii::app()->params['userNewsPath'] . $imageName); //перезапись уже ужатой картинкой
					
                }
                else{
                    $model->image_name=$oldfilename;
                }
				if($model->save()){
					$this->redirect(array('view','id'=>$model->id));
				}
				
			}
			
				
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('News', 
        array('sort' => array(
                'defaultOrder' => 'create_time DESC',),));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
