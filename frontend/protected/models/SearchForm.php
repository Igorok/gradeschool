<?php

/**
 * SearchForm class.
 * Данные для поиска в классе 'SiteController'.
 */
class SearchForm extends CFormModel
{
	public $query;

	/**
	 * Правила валидации
	 */
	public function rules()
	{
		return array(
			// Поисковая фраза
			array('query', 'required', 'message'=>'Поле {attribute} должно быть заполнено'),
		);
	}

	/**
	 * Лейблы для полей
	 */
	public function attributeLabels()
	{
		return array(
			'query'=>'Поиск',
		);
	}

	/**
	 * Поиск по php api
	 */
	public function searchQuery($query)
	{
		$search = Yii::App()->search;
		$search->setSelect('*');
		$search->setArrayResult(true);
		$search->setMatchMode(SPH_MATCH_EXTENDED2);
		$search->SetLimits(0,10,1000);
		$search->setSortMode(SPH_SORT_RELEVANCE);
		$search->SetFieldWeights(array('title' => 20, 'short_description' => 10));
		// result array
		$resArray = $search->query( $query, '*');
		return $resArray;
	}

}