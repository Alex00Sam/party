
<?php
class Qty extends \atk4\data\Model {
	public $table = 'qty';
	function init() :void{
		parent::init();
		$this->addField('qty',['type'=>'integer','default' => 1]);
		
	}
}
