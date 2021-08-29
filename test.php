  <?php
  //require 'vendor/autoload.php';
  require 'init.php';
/*$log = new \atk4\login\Auth();
$log->setModel(new Users($db));*/
 $crud4=$app->add('CRUD',['displayFields'=>['name']]);
 $crud4->setModel(new SlotsUsers($db));
