<?php
class LeftUserInfo extends CWidget {
	
	public function run() {
        if(!Yii::app()->user->isGuest) {
            $userModel = User::model()->findByPK(Yii::app()->user->id);
        }
        else{
            $userModel = null;
        }

		$this->render('leftUserInfo', array(
            'userModel' => $userModel,
        ));
	}
}