<?php

class HomeController extends Controller
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$post_category = Postcategory::model()->findAll();
		$image_category = Imagecategory::model()->findAll();
		$audio_category = Audiocategory::model()->findAll();
		$video_category = Videocategory::model()->findAll();
		
		
		
		$this->render('index',array(
			'post_category'=>$post_category,
			'image_category'=>$image_category,
			'audio_category'=>$audio_category,
			'video_category'=>$video_category,
		));
	}
}
