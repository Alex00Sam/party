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

  //  $this->addField('country',['caption'=>'Страна']);
   // $this->addField('city',['caption'=>'Город']);
	//	$this->addField('rating');
		//$this->addField('gender', ['Radio'], ['enum'=>['Мужской','Женский','Не указано']]);
 //   $this->addField('gender',['enum'=>['Мужской','Женский','Не указано'],'caption'=>'Пол']);
//		$this->addField('description',['caption'=>'Описание']);
//		$this->addField('vk',['caption'=>'Ссылка на страницу ВКонтакте']);
//		$this->addField('inst',['caption'=>'Ссылка на страницу Instagram']);
//    $this->addField('image',['caption'=>'Изображение (URL из интернета)']);
        $this->addField('category',['enum'=>['pardevejs','konsultants'],'caption'=>'Amats']);
		$this->addField('dob',['caption'=>'Dzimšanas datums','type'=>'date']);
        $this->addField('phone',['caption'=>'Tālr. numurs']);
        $this->addField('w_from',['caption'=>'Номер телефона']);
        $this->addField('w_till',['caption'=>'Номер телефона']);
        $this->addField('w_days',['caption'=>'darba dienas']);
        $this->addField('hourly_salary',['caption'=>'Stundas apmaksa']);
        $this->addExpression('total','([w_till]-[w_from])*[hourly_salary]*5');
		$this->hasMany('SlotsUsers',new SlotsUsers());
	}
}
