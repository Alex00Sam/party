<?php
require 'init.php';
$slot = new Slots($db);

  $form =$app->add('Form');
  $form -> setModel($slot,['name','description','image','date','time','is_private']);
  $form->onSubmit(function($f)use($slot,$db,$current_user){

    $f->model->save();
    $su=new SlotsUsers($db);
    $slot['creator_id']=$_SESSION['user_id'];
    $slot->save();
    $su['slots_id']=$slot->id;
    $su['users_id']=$_SESSION['user_id'];
    $su['slots_rating']=$current_user['rating'];
    $su->save();
    return new \atk4\ui\jsExpression('document.location="index.php"');
  });
