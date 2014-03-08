<?php

class PostcategoryController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
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
        $dataProvider=new CActiveDataProvider('Post', array(
            'criteria'=>array(
                'condition'=>'category_id=' . $id . ' AND status_id=1',
            ),
            'sort' => array(
                'defaultOrder' => 'create_time DESC',),
        ));
		$categoryName = Postcategory::model()->findByPk($id);
        
		$this->render('view',array(
			'dataProvider'=>$dataProvider,
			'categoryName'=>$categoryName,
		));
        
		// $this->render('view',array(
			// 'model'=>$this->loadModel($id),
		// ));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Postcategory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Postcategory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Postcategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Postcategory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
