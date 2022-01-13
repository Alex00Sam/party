<?php
require 'init.php';

$crud2 = $app->layout->add('CRUD', ['displayFields' => ['id', 'login', 'name', 'surname', 'phone', 'rating']]);
//	$crud2->table->resizableColumn('',[100,100,100,100,100,100],['resizeMode'=>'fit','minWidth'=>100]);
$crud2->setModel(new Users($db));
$crud1 = $app->layout->add('CRUD', ['displayFields' => ['id', 'name', 'total_rating', 'date', 'time']]);

$crud1->table->resizableColumn('', [50, 200, 100, 100, 100]);
$crud1->setModel(new Slots($db));

//	$crud3=$app->layout->add('CRUD');
//	$crud3->table->resizableColumn('',[100,100,100,100,100,100],['resizeMode'=>'fit','minWidth'=>100]);
//	$crud3->setModel(new SlotsUsers($db));
//$crud->addColumn('gender', ['Radio'], ['enum'=>['Мужской','Женский','Не указано']]);
//	$app->add(['Button','Homepage','icon'=>'undo'])->link('index.php');
