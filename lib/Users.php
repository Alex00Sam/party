<?php

class Users extends \atk4\data\Model {
	public $table = 'users';
	function init() :void{
		parent::init();
		$this->addField('login',['required'=>'true','caption'=>'Логин']);
		$this->addField('password',['type'=>'password','required'=>'true','caption'=>'Пароль']);
		$this->addField('name',['caption'=>'Имя','required'=>'true']);
    $this->addField('surname',['caption'=>'Фамилия']);
    $this->addField('email',['caption'=>'Электронная почта']);
    $this->addField('phone',['caption'=>'Номер телефона']);
    $this->addField('country',['caption'=>'Страна']);
    $this->addField('city',['caption'=>'Город']);
		$this->addField('rating');
		//$this->addField('gender', ['Radio'], ['enum'=>['Мужской','Женский','Не указано']]);
    $this->addField('gender',['enum'=>['Мужской','Женский','Не указано'],'caption'=>'Пол']);
		$this->addField('description',['caption'=>'Описание']);
		$this->addField('vk',['caption'=>'Ссылка на страницу ВКонтакте']);
		$this->addField('inst',['caption'=>'Ссылка на страницу Instagram']);
    $this->addField('image',['caption'=>'Изображение (URL из интернета)']);
		$this->addField('dob',['caption'=>'Дата рождения','type'=>'date']);

		$this->hasMany('SlotsUsers',new SlotsUsers());
	}
}
