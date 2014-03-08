<?php
class SearchField extends CWidget {
	
	public function run() {
        $searchFormModel = new SearchForm;

		$this->render('searchField',array(
            'searchFormModel'=>$searchFormModel,
        ));
	}
}