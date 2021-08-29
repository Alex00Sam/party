<?php

class Users extends \atk4\data\Model {
	public $table = 'users';
	function init() :void{
		parent::init();
		$this->addField('login');
		$this->addField('password',['type'=>'password']);
		$this->addField('name',['caption'=>'Имя']);
    $this->addField('surname',['caption'=>'Фамилия']);
    $this->addField('email');
    $this->addField('phone');
    $this->addField('country');
    $this->addField('city');
		$this->addField('rating');
		//$this->addField('gender', ['Radio'], ['enum'=>['Мужской','Женский','Не указано']]);
    $this->addField('gender',['enum'=>['Мужской','Женский','Не указано'],'caption'=>'Пол']);
		$this->addField('description',['type'=>'textarea']);
		$this->addField('vk');
		$this->addField('inst');
    $this->addField('image');
		$this->addField('age');

		$this->hasMany('SlotsUsers',new SlotsUsers());
	}
}
