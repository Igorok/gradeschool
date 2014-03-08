<?php

class VoteAnswerController extends Controller
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
			array('allow',
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionVoting()
	{
        if(isset($_POST))
		{
            if($_POST['voteRadio']){
                // id ответа
                $answerId = $_POST['voteRadio'];
                // находим ответ увеличиваем голос на 1
                $answerCurrent = VoteAnswer::model()->findByPk((int)$_POST['voteRadio']);
                $answerCurrent->answer_count++;

                // получаем все ответы на данный вопрос
                $answerAll = VoteAnswer::model()->findAll('question_id=' . $answerCurrent->question_id);
                // число голосов за ответ
                $allCount = 0;
                foreach($answerAll as $oneAnswer):
                    $allCount += $oneAnswer->answer_count;
                endforeach;
                // ответ во вьюху
                $dataResult = null;
                foreach($answerAll as $oneAnswer):
                    $dataResult .= $oneAnswer->description . ' - ' . round($oneAnswer->answer_count / $allCount * 100) . '% <div class="listborder_result" style="width:' . round($oneAnswer->answer_count / $allCount * 100) . '%;">' . round($oneAnswer->answer_count / $allCount * 100) . '%</div>';
                endforeach;
                // ответ сформирован
                                
                // если у пользователя еще нет куки
                if (!Yii::app()->request->cookies['school_' . Yii::app()->user->id]) {
                    // формируем cookies value пишем id вопроса
                    $arrayCookies = array(
                        'user_id'=>Yii::app()->user->id,
                        'vote_id'=> array(
                            $answerCurrent->question_id,
                        ),
                    );
                    // преобразуем массив в строку
                    $valueCookies = serialize($arrayCookies);
                    // формируем куку
                    $userCookie = new CHttpCookie('school_' . Yii::app()->user->id, $valueCookies);
                    $userCookie->expire = time()+60*60*24*365; 
                    // записываем куку
                    Yii::app()->request->cookies['school_' . Yii::app()->user->id] = $userCookie;
                }
                // если есть кука
                else {
                    // читаем куку разбираем в массив
                    $readCookie = Yii::app()->request->cookies['school_' . Yii::app()->user->id]->value;
                    $arrayRead = unserialize($readCookie);
                    // дописываем в список вопросов, новый вопрос
                    $arrayRead['vote_id'][] = $answerCurrent->question_id;
                    // формируем куку
                    $userCookie = new CHttpCookie('school_' . Yii::app()->user->id, serialize($arrayRead));
                    $userCookie->expire = time()+60*60*24*365; 
                    Yii::app()->request->cookies['school_' . Yii::app()->user->id] = $userCookie;
                }
                // сохраняем объект ответов если он валиден и отправляем ответ
                if($answerCurrent->save()){
                    echo json_encode($dataResult);
                }
            }
            else{
                echo '<strong>Выберите ответ</strong>';
            }
		}
	}

}
