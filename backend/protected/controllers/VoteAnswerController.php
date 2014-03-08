<?php

class VoteAnswerController extends Controller
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
			array('allow',
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
		$model=new VoteAnswer;
        
		// делаем выборку всех категорий из баззы данных
		$questionModel = VoteQuestion::model()->findAll();
		// при помощи listData создаем массив вида $ключ=>$значение
		$listQuestion = CHtml::listData($questionModel, 'id', 'title');
        
        // делаем выборку всех категорий из баззы данных
		$statusModel = Status::model()->findAll();
		// при помощи listData создаем массив вида $ключ=>$значение
		$listStatus = CHtml::listData($statusModel, 'id', 'title');
        
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VoteAnswer']))
		{
			$model->attributes=$_POST['VoteAnswer'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'listQuestion'=>$listQuestion,
			'listStatus'=>$listStatus,
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
        
        // делаем выборку всех категорий из баззы данных
		$questionModel = VoteQuestion::model()->findAll();
		// при помощи listData создаем массив вида $ключ=>$значение
		$listQuestion = CHtml::listData($questionModel, 'id', 'title');
        
        // делаем выборку всех категорий из баззы данных
		$statusModel = Status::model()->findAll();
		// при помощи listData создаем массив вида $ключ=>$значение
		$listStatus = CHtml::listData($statusModel, 'id', 'title');
        
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VoteAnswer']))
		{
			$model->attributes=$_POST['VoteAnswer'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'listQuestion'=>$listQuestion,
			'listStatus'=>$listStatus,
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
		$dataProvider=new CActiveDataProvider('VoteAnswer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new VoteAnswer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VoteAnswer']))
			$model->attributes=$_GET['VoteAnswer'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return VoteAnswer the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=VoteAnswer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param VoteAnswer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vote-answer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
