
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
$slot = new Slots($db);
$menu=$app->add('Menu')->addMenu('Сортировать по:');
$rat = $menu->addItem('По рейтингу');
$dat = $menu->addItem('По дате');

$columns = $app->add('Columns');
$col1 = $columns->addColumn(4);
$col2 = $columns->addColumn(4);
$col3 = $columns->addColumn(4);


$i=1;
foreach($slot as $a){
//  $card = new Cards($a);
//  $card->link(['index']);
  switch($i++){
    case 1:$col1->add(new Cards($a));//->add(['ui' => 'rating disabled']);->js(true)->rating(['maxRating' => 5, 'initialRating' => round($a['rating'])]);
           $col1->add(['ui'=>'hidden divider']);
           break;
    case 2:$col2->add(new Cards($a));//->add(['ui' => 'rating disabled']);//->js(true)->rating(['maxRating' => 5, 'initialRating' => round($a['rating'])]);
           $col2->add(['ui'=>'hidden divider']);
           break;
    case 3:$col3->add(new Cards($a));//->add(['ui' => 'rating disabled']);//->js(true)->rating(['maxRating' => 5, 'initialRating' => round($a['rating'])]);
           $col3->add(['ui'=>'hidden divider']);
           $i=1;
           break;
  }
}


$rat->on('click',function($b)use($columns,$slot){
  $slot->setOrder('total_rating');
  return [$columns->jsReload()];
});
$dat->on('click',function($b)use($columns,$slot){
  $slot->setOrder('date');
  return [$columns->jsReload()];
});
//$map = new \atk4\ui\View(['template' => new \atk4\ui\Template('<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=R%C4%ABga%2C%20%D0%9B%D0%B0%D1%82%D0%B2%D0%B8%D1%8F&key=AIzaSyDyaaCYY8N0TZsKiz--wJ2pyC3edh3Ik2I"></iframe>')]);
//$app->add($map);
//$col3->add(['Button','click'])->link(['index','id'=>2]);
/* $slot->load(4);
$card = new Cards($slot);
$col1->add($card); */
//$col2->add(new \atk4\ui\View(['ui'=>'segment']))->link(['index']);
//$col2->add($card);
//$img = $app->add(['Image',$slot['image']]);


?>
