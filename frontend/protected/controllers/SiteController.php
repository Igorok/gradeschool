<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
				'foreColor'=>0x6DBAE5,

			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	
	
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				
				// если аякс запрос
				if(Yii::app()->request->isAjaxRequest){
					// Use CJSON::encode() instead of json_encode() if you are encoding a Yii model
					echo CJSON::encode('Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.');
					// Properly end the app 
					Yii::app()->end();
				}
				else{
					Yii::app()->user->setFlash('contact','Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.');
					$this->refresh();
				}
				
			}
			else {
				// если аякс запрос
				if(Yii::app()->request->isAjaxRequest){
					// Use CJSON::encode() instead of json_encode() if you are encoding a Yii model
					echo CJSON::encode(CActiveForm::validate($model));
					// Properly end the app 
					Yii::app()->end();
				}
			}



		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;
		
		// if it is ajax validation request
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {			
				$user_id = Yii::app()->user->id;				
				$user_model=User::model()->findByPk($user_id);				
				if($user_model->status->id!=1){					
					Yii::app()->user->logout();
					if(Yii::app()->request->isAjaxRequest){
						echo CJSON::encode('2');
						Yii::app()->end(); // Properly end the app 
					}
					else {
						$this->redirect('user/account');
					}
					
				}
				else {
					// $this->redirect(Yii::app()->user->returnUrl);
					if(Yii::app()->request->isAjaxRequest){
						echo CJSON::encode($user_model->username);
						Yii::app()->end(); // Properly end the app 
					}
					else {
						$this->redirect('user/account');
					}
				}
			}
			else{
			   //header('Content-type: application/json');
				if(Yii::app()->request->isAjaxRequest){
					echo CJSON::encode(CActiveForm::validate($model)); // Use CJSON::encode() instead of json_encode() if you are encoding a Yii model
					Yii::app()->end(); // Properly end the app 
				}
			}	
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	// image upload
	public function actionImageupload(){
        //var_dump($_POST);
		$model=new ImageUpload;
		if(isset($_POST))
		{
            //var_dump($_POST);
			// получаем данные из формы
			$model->filename=CUploadedFile::getInstance($model,'filename');
			if($model->validate()){
				// данные файла
				$sourcePath = pathinfo($model->filename->getName());
				// новое имя для файла
				$filename = 'image_'.time().'.'. $sourcePath['extension'];
				//Переменной $file присвоить путь, куда сохранится картинка без изменений
				$file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['previewPath'] . $filename;
				//var_dump($file);exit;
				$model->filename->saveAs($file);
				//Используем функции расширения CImageHandler;
				$ih = new CImageHandler(); //Инициализация
				Yii::app()->ih 
				->load($file) //Загрузка оригинала картинки
				->thumb('800', '800') //Создание превьюшки шириной 800px
				->save($_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['previewPath'] . $filename); //перезапись уже ужатой картинкой
				
				$ajaxAnswer = array(
					'status'=>'1',
					'answer'=>$filename,
				);
				// ответ в аякс форму
				echo CJSON::encode($ajaxAnswer);
				Yii::app()->end();
			}
			else {
				$ajaxAnswer = array(
					'status'=>'2',
					'answer'=>'Выберите файл формата jgp, png, gif',
				);
				// ответ в аякс форму
				echo CJSON::encode($ajaxAnswer);
				Yii::app()->end();
			}
			
		}
	}
	
	
	// image upload
	public function actionJcrop(){
		
		if(isset($_POST) && $_POST['image_name']!="")
		{
			$filepath = $_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['previewPath'] .$_POST['image_name'];
			$imagename = $_POST['image_name'];
			
			$ih = new CImageHandler();
			Yii::app()->ih
			->load($filepath)
			->crop($_POST['w'], $_POST['h'], $_POST['x'], $_POST['y'])
			->save($filepath);
			
			echo CJSON::encode($imagename);
			Yii::app()->end();
		}
		else {
			echo CJSON::encode('error'); exit;
		}
	}
	// registration
	public function actionRegistration()
	{
		$model=new User('check_registration');
		
		if(isset($_POST['User']))
		{
            
			$model->attributes=$_POST['User']; //Заполнить модель данными присланными пользователем
			// берем файл из папки превьюшек
			$file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->urlManager->baseUrl . Yii::app()->params['previewPath'] .$model->image_name; 
            
            
            if($model->validate()){
                
                // date of birth
                if(!empty($model->dob)){
                    $model->dob = ViewHelper::dateGen($model->dob);
                }
                //проверяю если выбрана картинка image_name то 
				if (!empty($model->image_name)){
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
            }
			if($model->save()){                
				$this->redirect(array('site/index'));
			}
			
		}

		$this->render('registration',array(
			'model'=>$model,
		));
	}
	
	
	public function actionSearch()
	{
		$searchFormModel = new SearchForm;
		
        if(Yii::app()->request->isPostRequest){
        	if(isset($_POST['SearchForm']))
			{
				$searchFormModel->attributes=$_POST['SearchForm'];
	            if($searchFormModel->validate()){
	            	// вырезаю все теги
	            	$searchFormModel->query = strip_tags($searchFormModel->query);
	            	// поиск в сфинксе
	            	$allQuery = $searchFormModel->searchQuery($searchFormModel->query);

	            	// если индексы найдены
	            	if(!empty($allQuery['matches'])){
	            		// составляем массив из ответа api
	            		$searcRetArr = array();
						foreach($allQuery['matches'] as $oneArr){
							$searcRetArr[] = array(
								'id' => $oneArr['id'],
								'create_time' => $oneArr['attrs']['create_time'],
								'model_name' => $oneArr['attrs']['model_name'],
							);
						}
						// если массив не пустой
						if(!empty($searcRetArr)){
							// массив который будем выводить на экран
							$searcRenderArr = array();
							// id массива
							$idRenderArr = 0;
							foreach($searcRetArr as $oneSearcRetArr){
								switch ($oneSearcRetArr['model_name']) {
								    case 0:
								        $renderModel = Image::model()->findByPk($oneSearcRetArr['id']);
								        $imagePath = Yii::app()->params['userImagesPath'];
								        break;
								    case 1:
								        $renderModel = Post::model()->findByPk($oneSearcRetArr['id']);
								        $imagePath = Yii::app()->params['userPostsPath'];
								        break;
								    case 2:
								        $renderModel = News::model()->findByPk($oneSearcRetArr['id']);
								        $imagePath = Yii::app()->params['userNewsPath'];
								        break;
								    case 3:
								        $renderModel = Audio::model()->findByPk($oneSearcRetArr['id']);
								        $imagePath = Yii::app()->params['userAudiosPath'];
								        break;
							        case 4:
								        $renderModel = Video::model()->findByPk($oneSearcRetArr['id']);
								        $imagePath = Yii::app()->params['userVideosPath'];
								        break;
								}
								// записываем данные в массив для вывода на страницу
								if(!empty($renderModel)){
									$searcRenderArr[] = array(
										'id' => $idRenderArr,
										'image_name' => $renderModel->image_name ? $imagePath . $renderModel->image_name : null,
										'url' => $renderModel->url,
										'title' => $renderModel->title,
										'short_description' => $renderModel->short_description,
										'create_time' => $renderModel->create_time,
									);
									$idRenderArr++;
								}
								
							}
							// формируем объект для вывода в стандартном виджете
							$dataProvider=new CArrayDataProvider($searcRenderArr, array(
								'id' => 'id',
						        'pagination'=>array(
						            'pageSize'=>10,
						        ),
						    ));
						    
							// вывод вьюхи
							if(empty($dataProvider))
								throw new CHttpException(404,'По вашему запросу ничего не найдено');
							
							$this->render('searchresult',array(
						        'dataProvider'=>$dataProvider,
						    ));
						}

	            	}
	            	// если индексов нету, вешаем сообщение
	            	else {
	            		Yii::app()->user->setFlash('search','Сожалеем по вашему запросу ничего не найдено');
						$this->refresh();
	            	}
	            }
	            // если пост запрос не прошел валидацю
	            else {
		        	Yii::app()->user->setFlash('search','Введите слово для поиска');
					$this->render('search', array('searchFormModel' => $searchFormModel,));
		        }

	        }
	        
        }
        else {
        	// гет запрос
			$this->render('search', array('searchFormModel' => $searchFormModel,));
        }
		
	}
	
	// loginza
	public function actionLoginzaLogin() {
    //проверяем, пришел ли token
    if (isset($_POST['token'])) {
        $loginza = new LoginzaModel();
        $loginza->setAttributes($_POST);
        $loginza->getAuthData();
        if ($loginza->validate() && $loginza->login()) {
            //возвращаем пользователя на ту страницу на которой он
            //находился перед аутентификацией
            $this->redirect(Yii::app()->user->returnUrl);
        }
        else {
            //сообщение об ошибке
            $this->render('loginzaerror');
        }
    }
    else {
        //если этот метод вызван напрямую (без указания token)
        $this->redirect(Yii::app()->homeUrl, true);
    }
}
}