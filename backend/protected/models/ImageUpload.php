<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ImageUpload extends CFormModel
{
	public $filename;
	public $file;
	public function rules()
	{
		return array(
			// filename are required
			array('filename', 'required'),
			array('filename', 'file', 'types' => 'gif, jpg, jpeg, png', 'message'=>'Выберите файл формата jgp, png, gif', 'allowEmpty' => false),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'filename'=>'Выберите изображение',
		);
	}
	
	public function uploadfile($filename)
	{
		
	}
	
	
	
}
