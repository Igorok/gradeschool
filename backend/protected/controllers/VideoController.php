<?php

class VideoController extends Controller
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
		$model=new Video;
		$video_category=Videocategory::model()->findAll();
		$list_data=CHtml::ListData($video_category, 'id', 'name');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        if(isset($_POST['Video']))
		{
            $model->attributes=$_POST['Video'];
            
			// получаем данные о загруженном файле
			$model->image_name=CUploadedFile::getInstance($model,'image_name');
			// если модель прошла валидацию 
			if($model->validate())
			{   
                if(!empty($model->image_name)){
                    // данные файла
                    $sourcePath = pathinfo($model->image_name->getName());
                    // новое имя для файла
                    $imageName = 'video_' . time().'.'. $sourcePath['extension'];
                    
                    //Переменной $file присвоить путь, куда сохранится картинка без изменений, параметры тянутся из конфига
                    $file = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->getBaseUrl() . Yii::app()->params['userVideosPath'] .$imageName;
                    $model->image_name->saveAs($file);
                    $model->image_name=$imageName;
                    //Используем функции расширения CImageHandler;
                    $ih = new CImageHandler(); //Инициализация
                    Yii::app()->ih 
                    ->load($file) //Загрузка оригинала картинки
                    ->thumb('800', '800') //Создание превьюшки шириной 800px по длинной стороне
                    ->save($_SERVER['DOCUMENT_ROOT'] . Yii::app()->getBaseUrl() . Yii::app()->params['userVideosPath'] . $imageName); //перезапись уже ужатой картинкой
					
                }
				if($model->save()){
					$this->redirect(array('view','id'=>$model->id));
				}
            }
			
			
		}

		$this->render('create',array(
			'list_data'=>$list_data,
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
		$video_category=Videocategory::model()->findAll();
		$list_data=CHtml::ListData($video_category, 'id', 'name');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        if(isset($_POST['Video']))
		{
			// получаем имя старого файла
            $oldfilename = $model->image_name; 
			$model->attributes=$_POST['Video'];
            
			// получаем данные о загруженном файле если файл выбран
            $model->image_name=CUploadedFile::getInstance($model,'image_name');
            
            
			// если модель прошла валидацию 
			if($model->validate())
			{
                if(!empty($model->image_name)){
                    // данные файла
                    $sourcePath = pathinfo($model->image_name->getName());
                    // новое имя для файла
                    $imageName = 'video_' . time().'.'. $sourcePath['extension'];
                    //Переменной $file присвоить путь, куда сохранится картинка без изменений, параметры тянутся из конфига
                    $file = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->getBaseUrl() . Yii::app()->params['userVideosPath'] .$imageName;
                    $model->image_name->saveAs($file);
                    $model->image_name=$imageName;
                    //Используем функции расширения CImageHandler;
                    $ih = new CImageHandler(); //Инициализация
                    Yii::app()->ih 
                    ->load($file) //Загрузка оригинала картинки
                    ->thumb('800', '800') //Создание превьюшки шириной 800px по длинной стороне
                    ->save($_SERVER['DOCUMENT_ROOT'] . Yii::app()->getBaseUrl() . Yii::app()->params['userVideosPath'] . $imageName); //перезапись уже ужатой картинкой
					
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
			'list_data'=>$list_data,
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
		$dataProvider=new CActiveDataProvider('Video', array(
             'sort' => array(
                'defaultOrder' => 'create_time DESC'))
        );
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Video('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Video']))
			$model->attributes=$_GET['Video'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Video the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Video::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Video $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='video-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
