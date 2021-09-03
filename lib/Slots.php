
<?php



class Slots extends \atk4\data\Model {
	public $table = 'slots';
//	public $total_rating;
	function init() :void{
		parent::init();

		$this->addField('name',['caption'=>'Название','required'=>'true']);
		$this->addField('image',['caption'=>'Изображение (URL из интернета)']);
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


		$this->addField('description',['caption'=>'Описание']);
		$this->addField('male');
		$this->addField('female');
//		$this->addFields(['male','female']);//,['read_only'=>true]);
  //	$this->addExpression('total', '[male] + [female]');
		$this->addField('gender',['type'=>'boolean','caption'=>'Пол']);
		$this->addField('is_private',['caption'=>'Частное мероприятие','type'=>'boolean']);
		$this->addField('creator_id');
		$this->addField('date',['caption'=>'Дата','type'=>'date','required'=>'true']);
		$this->addField('time',['caption'=>'Время','type'=>'time']);
		$this->addField('place',['caption'=>'Место (адрес)','required'=>'true']);
		$this->addField('showmap',['type'=>'boolean','caption'=>'Показавыть карту']);
		$this->addField('capacity',['caption'=>'Максимальное число участников']);


	}
}
