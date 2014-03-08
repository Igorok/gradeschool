<?php
class UserVote extends CWidget {
	
	public function run() {
        // все вопросы голосования
        $allVote = VoteQuestion::model()->findAll();
    
        // проверка гость
        if(!Yii::app()->user->isGuest){
            // если у пользователя еще нет куки
            if (!Yii::app()->request->cookies['school_' . Yii::app()->user->id]) {
                // cookies value
                $arrayCookies = array(
                    'user_id'=>Yii::app()->user->id,
                    'vote_id'=> array(
                        0,
                    ),
                );
                // преобразуем массив в строку
                $valueCookies = serialize($arrayCookies);
                // составляем куку
                $userCookie = new CHttpCookie('school_' . Yii::app()->user->id, $valueCookies);
                // на год
                $userCookie->expire = time()+60*60*24*365;
                // пишем куку
                Yii::app()->request->cookies['school_' . Yii::app()->user->id] = $userCookie;
            }
            // если есть кука
            else {
                // читаем куку
                $readCookie = Yii::app()->request->cookies['school_' . Yii::app()->user->id]->value;
                // преобразуем строку в массив
                $arrayRead = unserialize($readCookie);
                // если вопросы голосования получены и есть кука с голосованиями юзера
                if($allVote && $arrayRead['vote_id']){
                    foreach($allVote as $oneVote){
                        // если во всех голосованиях нет тех за которые юзер уже проголосовал пишем их в новый массив, и рандомно выбираем одно значение из него
                        if(!in_array($oneVote->id, $arrayRead['vote_id'])){ 
                            $resultArray[] = $oneVote->id;
                            $randIndex = array_rand($resultArray, 1);
                            $randVote = $resultArray[$randIndex];
                            // получаем вопрос голосования
                            $needVote = VoteQuestion::model()->findByPk($randVote);
                        }
                    }
                }
                // рендим контент если получили нужный вопрос
                if(isset($needVote)){
                    $this->render('userVote', array(
                        'needVote' => $needVote,
                    ));
                }
            }
        }
	}
	
}