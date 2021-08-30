<?php

class Cards extends \atk4\ui\View {

    public $ui = 'button';
    public $rating;


    public function __construct($obj)  {

    //    $rating = new \atk4\ui\View(['ui' => 'rating disabled']);
  //      $rating->js(true)->rating(['maxRating' => 5, 'initialRating' => round($obj['rating'])])->reload();

        $this->init();
      //  $this->id = '#_atk_'.$obj->id;
        $this->add(['Image',$obj['image'],'rounded']);
        $this->add(['Header',$obj['name']]);
    //    $this->add($rating);
    //    unset($rating);
        $this->link(['party','id'=>$obj->id]);
        $rating = new \atk4\ui\View(['ui' => 'rating disabled']);
        $rating->id = '_rating_'.$obj->id;
        if($obj['total_rating']){
          $rating->js(true)->rating(['maxRating' => 5, 'initialRating' => round($obj['total_rating'])]);//->clear();
        }else{
          $rating->js(true)->rating(['maxRating' => 5, 'initialRating' => round($obj['rating'])]);//->clear();
        }
        $this->add($rating);
        $this->add(['Label',$obj['total'],'icon'=>'users']);
    //    $this->js()->clear();
      //  unset($this->_js_actions);
    }

/*    function __construct() {
  //    $image = new \atk4\ui\Image($id);
  //    $seg = $thisnew \atk4\ui\View(['ui'=>'segment']);
      $this->link('index.php');
      $this->add(['Image',$id]);
      $this->add(['Header','Hello','aligned'=>'center']);
  //    $this->on('click', new \atk4\ui\jsExpression('document.location="index.php"'));
    //  $this->renderAll();
      //$this->link('index.php');
  //    $this->render();


      //  parent::__construct('Vecāku diena');

          /*
            $this->initLayout('Centered');

            $this->layout->template->del('Header');

            $logo = 'logo.png';

            $this->layout->add(['Image',$logo,'small centered'],'Header');
            //$this->layout->add(['Label','Work','red right'],'Header');


            $this->layout->add([
                'Header',
                'Vecāku diena',
                'size'=>'huge',
                'aligned' => 'center',
            ], 'Header');

        }elseif($mode == 'admin') {
            $this->initLayout('Admin');
            $this->layout->leftMenu->addItem(['Galvenā lapa', 'icon'=>'home'], ['logout']);
            $this->layout->leftMenu->addItem(['Priekšmeti', 'icon'=>'book'], ['admin','check'=>'lessons']);
            $this->layout->leftMenu->addItem(['Skolotāji', 'icon'=>'users'], ['admin','check'=>'teachers']);
            $this->layout->leftMenu->addItem(['Ieraksti', 'icon'=>'unordered list'], ['admin']);
        }elseif($mode == 'print') {
            $this->initLayout('Centered');

            $this->layout->template->del('Header');
        }
       if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
            $this->db = \atk4\data\Persistence::connect($_ENV['CLEARDB_DATABASE_URL']);
        } else {
            $this->db = \atk4\data\Persistence::connect('mysql:host=127.0.0.1;dbname=scheduler;charset=utf8', 'MySite', '12345');
        }


}*/
 /*
function onClick(){

}*/
}
