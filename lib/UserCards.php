<?php

class UserCards extends \atk4\ui\View {

    public $ui = 'button';
    public $rating;
  //  public $class =['tiny'];

    public function __construct($obj)  {

    //    $rating = new \atk4\ui\View(['ui' => 'rating disabled']);
  //      $rating->js(true)->rating(['maxRating' => 5, 'initialRating' => round($obj['rating'])])->reload();

        $this->init();
      //  $this->id = '#_atk_'.$obj->id;
      $columns = $this->add('Columns');
      $col1 = $columns->addColumn(8);
      $col2 = $columns->addColumn(8);
        $col2->add(['Image',$obj['image'],'tiny rounded']);
        $col1->add(['Header',$obj['name']]);
    //    $this->add($rating);
    //    unset($rating);

        $rating = new \atk4\ui\View(['ui' => 'rating disabled']);
        $rating->id = '_rating_'.$obj->id;
          $this->link(['profile','id'=>$obj->id]);
          $rating->js(true)->rating(['maxRating' => 5, 'initialRating' => round($obj['rating'])]);
        $col1->add($rating);

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
