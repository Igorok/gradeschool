<?php
class LeftNews extends CWidget {
	
	public function run() {
        $criteria=new CDbCriteria;
        $criteria->limit=3;
        $criteria->order='create_time DESC';
        
        $someNews = News::model()->findAll($criteria);
        
		$this->render('leftNews', array(
			'someNews' => $someNews,
		));
	}
	
}