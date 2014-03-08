<?php

class PostController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + postLike, postDislike', // we only allow deletion via POST request
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'mypost', 'postLike', 'postDislike'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actions()
    {
        return array(
            'postLike'=>array(
                'class' => 'application.components.PostLikeAction',
                'modelName' => 'PostLike'
            ),
            'postDislike'=>array(
                'class' => 'application.components.PostLikeAction',
                'modelName' => 'PostDislike'
            ),
        );
    }

	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
        $model=$this->loadModel($id);
        // если модель не существует
		if($model===null){
			throw new CHttpException(404,'Пост не найден');
        }
        // если статья не одобрена
        else if($model->status_id != 1){
            // если автор статьи совпадает с текущим пользователем
            if($model->user_id == Yii::app()->user->id)
            {
                // форма комментариев
                $postCommentsForm = new PostComments;

                // все комментарии
                $allCommentsCriteria = new CDbCriteria;
                $allCommentsCriteria->condition = 'post_id=' . (int)$id;
                $allCommentsCriteria->order = 'create_time DESC';
                $postCommentsAll = PostComments::model()->findAll($allCommentsCriteria);

                // получаю лайки для статьи
                $postLikeCount = PostLike::model()->count(array(
                    'condition'=>'post_id=' . (int)$id,
                ));
                
                // получаю дислайки для статьи
                $postDislikeCount = PostDislike::model()->count(array(
                    'condition'=>'post_id=' . (int)$id,
                ));

                $this->render('view',array(
                    'postLikeCount'=>$postLikeCount,
                    'postCommentsAll'=>$postCommentsAll,
                    'postDislikeCount'=>$postDislikeCount,
                    'postCommentsForm'=>$postCommentsForm,
                    'model'=>$this->loadModel($id),
                ));
            }
            // если статья не одобрена и пользователь не автор статьи
            else{
                throw new CHttpException(403,'У Вас нет прав на просмотр статьи!');
            }
            
        }
        // если статья прошла одобрение
        else {
            // форма комментариев
            $postCommentsForm = new PostComments;

            // все комментарии
            $allCommentsCriteria = new CDbCriteria;
            $allCommentsCriteria->condition = 'post_id=' . (int)$id;
            $allCommentsCriteria->order = 'create_time DESC';

            $postCommentsAll = PostComments::model()->findAll($allCommentsCriteria);

            // получаю лайки для статьи
            $postLikeCount = PostLike::model()->count(array(
                'condition'=>'post_id=' . (int)$id,
            ));
            
            // получаю дислайки для статьи
            $postDislikeCount = PostDislike::model()->count(array(
                'condition'=>'post_id=' . (int)$id,
            ));

            $this->render('view',array(
                'postLikeCount'=>$postLikeCount,
                'postCommentsAll'=>$postCommentsAll,
                'postDislikeCount'=>$postDislikeCount,
                'postCommentsForm'=>$postCommentsForm,
                'model'=>$this->loadModel($id),
            ));
        }
	}





	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Post;
		// делаем выборку всех категорий из баззы данных
		$postCategoryModel = Postcategory::model()->findAll();
		// при помощи listData создаем массив вида $ключ=>$значение
		$list = CHtml::listData($postCategoryModel, 'id', 'name');
		//var_dump($postCategoryModel);exit;

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			// получаем данные о загруженном файле
			$model->image_name=CUploadedFile::getInstance($model,'image_name');
			// если модель прошла валидацию 
			if($model->validate())
			{   
                if(!empty($model->image_name)){
                    // данные файла
                    $sourcePath = pathinfo($model->image_name->getName());
                    // новое имя для файла
                    $imageName = Yii::app()->user->id . '_' . time().'.'. $sourcePath['extension'];
                    //Переменной $file присвоить путь, куда сохранится картинка без изменений, параметры тянутся из конфига
                    $file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['userPostsPath'] .$imageName;
                    $model->image_name->saveAs($file);
                    $model->image_name=$imageName;
                    //Используем функции расширения CImageHandler;
                    $ih = new CImageHandler(); //Инициализация
                    Yii::app()->ih 
                    ->load($file) //Загрузка оригинала картинки
                    ->thumb('800', '800') //Создание превьюшки шириной 800px по длинной стороне
                    ->save($_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['userPostsPath'] . $imageName); //перезапись уже ужатой картинкой
					
                }
				if($model->save()){
					$this->redirect(array('view','id'=>$model->id));
				}
				
			}
            
		}

		$this->render('create',array(
			'model'=>$model,
			'list'=>$list,
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
        // если юзер автор статьи 
        if($model->user_id == Yii::app()->user->id)
        {
            
		
            // делаем выборку всех категорий из баззы данных
            $postCategoryModel = Postcategory::model()->findAll();
            // при помощи listData создаем массив вида $ключ=>$значение
            $list = CHtml::listData($postCategoryModel, 'id', 'name');
            // получаем имя старого файла
            $oldfilename = $model->image_name; 
        
        
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            // post request
            if(isset($_POST['Post']))
            {   
                $model->attributes=$_POST['Post'];
                // получаем данные о загруженном файле
                $model->image_name=CUploadedFile::getInstance($model,'image_name');

                // если модель прошла валидацию 
                if($model->validate())
                {   
                    if(!empty($model->image_name)){
                        // данные файла
                        $sourcePath = pathinfo($model->image_name->getName());
                        // новое имя для файла
                        $imageName = Yii::app()->user->id . '_' . time().'.'. $sourcePath['extension'];
                        //Переменной $file присвоить путь, куда сохранится картинка без изменений, параметры тянутся из конфига
                        $file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['userPostsPath'] .$imageName;
                        $model->image_name->saveAs($file);
                        $model->image_name=$imageName;
                        //Используем функции расширения CImageHandler;
                        $ih = new CImageHandler(); //Инициализация
                        Yii::app()->ih 
                        ->load($file) //Загрузка оригинала картинки
                        ->thumb('800', '800') //Создание превьюшки шириной 800px по длинной стороне
                        ->save($_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['userPostsPath'] . $imageName); //перезапись уже ужатой картинкой
                        
                    }
                    else{
                        $model->image_name=$oldfilename;
                    }
                    if($model->save()){
                        $this->redirect(array('view','id'=>$model->id));
                    }
                    
                }
                
                    
            }
            // get request 
            $this->render('update',array(
                'model'=>$model,
                'list'=>$list,
            ));
            
        }
        // если пользователь не автор статьи
        else{
            throw new CHttpException(403,'У Вас нет прав на редактирование статьи!');
        }
		
        
	}

	/**
	 * Lists all models.
	 */
	public function actionMypost()
	{
		//выбор всех строк с создателем текцщим пользователем и сортировка по дате от первых к последним
		$dataProvider = new CActiveDataProvider('Post', array(
            'criteria'=>array(
                'condition'=>'user_id=' . Yii::app()->user->id,
            ),
            'sort' => array(
                'defaultOrder' => 'create_time DESC',),
        ));

        $this->render('mypost',array(
            'dataProvider'=>$dataProvider,
        ));
	}
    /**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//выбор всех строк со статусом 1 и сортировка по дате от первых к последним
		$dataProvider=new CActiveDataProvider('Post', array(
            'criteria'=>array(
                'condition'=>'status_id=1',
            ),
            'sort' => array(
                'defaultOrder' => 'create_time DESC',
            ),
        ));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Post the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{   
		$model=Post::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
            
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Post $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
