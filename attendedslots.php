
<?php
require 'init.php';
//Form//
/*$intro = $app->layout->add('Header')->set('Welcome to Money Lending App, where you can manage your friend loans and their returnings. Enjoy!');
$form = $app->layout->add('Form');
$form->setModel(new Friends($db));

$form->onSubmit(function($form) {
  $form->model->save();
  return $form->success('You have successfully added a new friend!');

});
$layout->add(['ui'=>'hidden divider']);
$crud = $app->layout->add('CRUD');

$crud->addColumn('name', new \atk4\ui\TableColumn\Link('loan.php?friends_id={$id}'));
$crud->setModel(new Friends($db));
*/
//$app->add(['Button','admin','icon'=>'dev'])->link('admin.php');

$columns = $app->add('Columns');
$col1 = $columns->addColumn(4);
$col2 = $columns->addColumn(4);
$col3 = $columns->addColumn(4);
$su = new SlotsUsers($db);
$su->addCondition('users_id',$_SESSION['user_id']);
if(!($su->tryLoadAny()->loaded())){
  $app->add(['Header','Список пуст!']);
}else{
  $i=1;
  foreach($su as $a){
    $slot = new Slots($db);
    $slot->tryLoad($a['slots_id']);

  //  $card = new Cards($a);
  //  $card->link(['index']);
    switch($i++){
      case 1:$col1->add(new Cards($slot));//->add(['ui' => 'rating disabled']);->js(true)->rating(['maxRating' => 5, 'initialRating' => round($a['rating'])]);
             $col1->add(['ui'=>'hidden divider']);
             break;
      case 2:$col2->add(new Cards($slot));//->add(['ui' => 'rating disabled']);//->js(true)->rating(['maxRating' => 5, 'initialRating' => round($a['rating'])]);
             $col2->add(['ui'=>'hidden divider']);
             break;
      case 3:$col3->add(new Cards($slot));//->add(['ui' => 'rating disabled']);//->js(true)->rating(['maxRating' => 5, 'initialRating' => round($a['rating'])]);
             $col3->add(['ui'=>'hidden divider']);
             $i=1;
             break;
    }
  }
}
//$col3->add(['Button','click'])->link(['index','id'=>2]);
/* $slot->load(4);
$card = new Cards($slot);
$col1->add($card); */
//$col2->add(new \atk4\ui\View(['ui'=>'segment']))->link(['index']);
//$col2->add($card);
//$img = $app->add(['Image',$slot['image']]);








































$str = 'LV25GASX';
for ($i = 1; $i <= 13; $i++) {
    $str = $str.rand(0,9);
}
