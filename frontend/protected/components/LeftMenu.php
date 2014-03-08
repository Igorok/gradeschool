<?php
class LeftMenu extends CWidget {
	// генерация массива с параметрами меню
	private function itemsMenu($classArray){
		if(!empty($classArray)){
			$itemsArray = array();
			foreach ($classArray as $oneClass) {
		        $itemsArray[] = array(
		            'label'       => $oneClass->name,
		            'url'         => array($oneClass->url),
		            //'template' => '<span>{menu}</span>',
		        );
		    }
		    return $itemsArray;
		}
		else {
			return false;
		}
	}

	public function run() {
		$postCategory = Postcategory::model()->findAll();
		$imageCategory = Imagecategory::model()->findAll();
		$audioCategory = Audiocategory::model()->findAll();
		$videoCategory = Videocategory::model()->findAll();
		// menu items
		$itemPost = $this->itemsMenu($postCategory);
		$itemImage = $this->itemsMenu($imageCategory);
		$itemAudio = $this->itemsMenu($audioCategory);
		$itemVideo = $this->itemsMenu($videoCategory);

		if(!empty($itemPost) || !empty($itemImage) || !empty($itemAudio) || !empty($itemVideo)) {
			$this->render('leftMenu', 
				array(
				'itemPost' => $itemPost, 
				'itemImage' => $itemImage,
				'itemAudio' => $itemAudio,
				'itemVideo' => $itemVideo,
			));
		}
	}

}