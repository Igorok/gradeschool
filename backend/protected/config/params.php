<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'My Yii Blog',
	// this is used in error pages
	'adminEmail'=>'ipatovsoft@gmail.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',
    // путь ко всем картинкам
	'imagePath'=>'/frontend/images/',
	// путь к превьюшке в регистрации
	'previewPath'=>'/frontend/images/image_preview/',
	// путь к аватарке пользователя
	'userImagePath'=>'/frontend/images/users_photo/',
	// путь к миниатюре аватарки
	'userThumbPath'=>'/frontend/images/users_thumb/',
	// путь к картинке поста
	'userPostsPath'=>'/frontend/images/posts/',
    // путь к картинке изображений
	'userImagesPath'=>'/frontend/images/images/',
    // путь к картинке  аудио
	'userAudiosPath'=>'/frontend/images/audios/',
    // путь к картинке Видео
	'userVideosPath'=>'/frontend/images/videos/',
    // путь к картинке Новости
	'userNewsPath'=>'/frontend/images/news/',
);
