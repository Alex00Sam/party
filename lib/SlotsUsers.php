
<?php
class SlotsUsers extends \atk4\data\Model {
	public $table = 'slots_users';
	function init() :void{
		parent::init();

		$this->hasOne('slots_id',new Slots());
		$this->hasOne('users_id',new Users());
		$this->addField('slots_rating');
        $this->addField('price');
		
	}
}
