
<?php



class Slots extends \atk4\data\Model {
	public $table = 'slots';
//	public $total_rating;
	function init() :void{
		parent::init();

		$this->addField('name');
		$this->addField('image');
		$su=$this->hasMany('SlotsUsers',new SlotsUsers());
		$su->addField('total_rating',['aggregate'=>'avg','field'=>'slots_rating']);
		$su->addField('total',['aggregate'=>'count']);
		/*$su = $this->ref('SlotsUsers');//->addField('total_rating', ['aggregate'=>'sum', 'field'=>'rating']);;
		$i=0;
		$sum=0;
		foreach($su as $a) {
			$u = new Users(new
			\atk4\data\Persistence\SQL('mysql:dbname=party;localhost', 'MySite', '12345'));
			$u->load($a['users_id']);
			$sum+=$u['rating'];
			$i++;
		}
		$this->total_rating = $sum/$i;*/
	//	$this->addField('rating');//->set($this->total_rating);


		$this->addField('description');
		$this->addField('male');
		$this->addField('female');
//		$this->addFields(['male','female']);//,['read_only'=>true]);
  //	$this->addExpression('total', '[male] + [female]');
		$this->addField('gender',['type'=>'boolean']);
		$this->addField('is_private',['type'=>'boolean']);
		$this->addField('creator_id');
		$this->addField('date',['type'=>'date']);
		$this->addField('time',['type'=>'time']);

	}
}
