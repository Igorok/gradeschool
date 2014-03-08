<div id="myCarousel" class="row carousel slide">
  <!-- Carousel items -->
  <div class="carousel-inner">
    <!-- slide -->
    <div class="active item">
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/frontend/images/slider/img1.jpg" alt="slide 1" />
      <!-- -->
      <div class="slide_desc">
        <div class="sd_text">
          <p class="headline">Картинки</p>
          <p>
            В этом разделе Вы найдете красивые картинки, привлекающие внимание детей с самого раннего возраста.
          </p>
          <?= CHtml::link('Подробнее', array('imagecategory/index'),array('class'=>'btn btn-yellow')); ?>
        </div>
      </div>
      <!-- -->
    </div>
    <!-- slide -->
    <div class="item">
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/frontend/images/slider/img2.jpg" alt="slide 1" />
      <!-- -->
      <div class="slide_desc">
        <div class="sd_text">
          <p class="headline">Расписание</p>
          <p>
            Расписания занятий с рамками для фотографий, иллюстрациями к сказкам и многое другое.
          </p>
          <?= CHtml::link('Подробнее', array('imagecategory/view', 'id'=>'3', 'pageUrl'=>'timetable'),array('class'=>'btn btn-yellow')); ?>
        </div>
      </div>
      <!-- -->
    </div>
    <!-- slide -->
    <div class="item">
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/frontend/images/slider/img3.jpg" alt="slide 1" />
      <!-- -->
      <div class="slide_desc">
        <div class="sd_text">
          <p class="headline">Раскраски</p>
          <p>
            Веселые раскраски для девочек и мальчиков с любимыми персонажами из мультфильмов и фильмов, из сказок, комиксов.
          </p>
          <?= CHtml::link('Подробнее', array('imagecategory/view', 'id'=>'1', 'pageUrl'=>'coloring'),array('class'=>'btn btn-yellow')); ?>
        </div>
      </div>
      <!-- -->
    </div>
    <!-- slide -->
    <div class="item">
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/frontend/images/slider/img4.jpg" alt="slide 1" />
      <!-- -->
      <div class="slide_desc">
        <div class="sd_text">
          <p class="headline">Аудио</p>
          <p>
            Любимые песни детей из мультфильмов. Аудио сказки и уроки для детей.
          </p>
          <?= CHtml::link('Подробнее', array('audiocategory/index'),array('class'=>'btn btn-yellow')); ?>
        </div>
      </div>
      <!-- -->
    </div>
    <!-- slide -->
    <div class="item">
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/frontend/images/slider/img5.jpg" alt="slide 1" />
      <!-- -->
      <div class="slide_desc">
        <div class="sd_text">
          <p class="headline">Мультики</p>
          <p>                                
            Всеми любимые мультики которые погружают ребёнка в мир фантазий и незабываемых приключений.
          </p>
          <?= CHtml::link('Подробнее', array('videocategory/view', 'id'=>'1', 'pageUrl'=>'cartoons'),array('class'=>'btn btn-yellow')); ?>
        </div>
      </div>
      <!-- -->
    </div>
    <!-- slide -->
    <div class="item">
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/frontend/images/slider/img6.jpg" alt="slide 1" />
      <!-- -->
      <div class="slide_desc">
        <div class="sd_text">
          <p class="headline">Фильмы</p>
          <p>                                
            Добрые фильмы для детей и всей семьи, которые учат быть дружными и отзывчивым.
          </p>
          <?= CHtml::link('Подробнее', array('videocategory/view', 'id'=>'2', 'pageUrl'=>'movies'),array('class'=>'btn btn-yellow')); ?>
        </div>
      </div>
      <!-- -->
    </div>
    <!-- slide -->
  </div>
  <!-- Carousel arrow -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
  <!-- -nav -->
  <ol class="carousel-indicators clearfix">
    <li data-target="#myCarousel" data-slide-to="0" class="active">Картинки</li>
    <li data-target="#myCarousel" data-slide-to="1" class="">Расписание</li>
    <li data-target="#myCarousel" data-slide-to="2" class="">Раскраски</li>
    <li data-target="#myCarousel" data-slide-to="3" class="">Аудио</li>
    <li data-target="#myCarousel" data-slide-to="4" class="">Мультики</li>
    <li data-target="#myCarousel" data-slide-to="5" class="">Фильмы</li>
  </ol>
  <!-- -nav -->
</div>