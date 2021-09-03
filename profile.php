<?php
  require 'init.php';
  $card = $app->add(['Card','','big centered']);
    $viewuser = new Users($db);
    $viewuser->load($_GET['id']);
  $card->addContent(new \atk4\ui\Header($viewuser['name']." ".$viewuser['surname']));
  $rating = new \atk4\ui\View(['ui' => 'massive rating disabled']);
  $rating->js(true)->rating(['maxRating' => 5, 'initialRating' => round($viewuser['rating'])]);
  //$r_label = $app->add(['Label',$slot['total_rating'],'circular massive']);
  $card->addContent($rating);

  $card->addImage($viewuser['image']);
  $s2 = $card->addSection('О себе',$viewuser,['dob','description','vk','inst',]);
  $s2->addClass('center aligned');
  $s2 = $card->addSection('Контакты',$viewuser,['email','phone','country','city']);
$vp = $app->add('VirtualPage');
$vp->set(function ($vp) use ($current_user) {
    $form = $vp->add('Form');
    $form->setModel(new Users($db), ['login', 'password', 'name', 'surname', 'dob', 'image', 'email', 'phone', 'country', 'city', 'gender', 'description', 'vk', 'inst']);
    $form->buttonSave->set('Сохранить');
    $form->onSubmit(function ($f) {
        $f->model->save();

        return new \atk4\ui\jsExpression('document.location=""');
    });

});
  if($_SESSION['user_id']==$viewuser->id) {

     // $mod = new \atk4\ui\jsModal('', $vp);
      //$mod->init();
     // $edit = new \atk4\ui\Button('Изменить');
     // $edit->init();
     // $app->add($edit);
      $edit = $app->add(['Button','test']);
      $edit->on('click',new \atk4\ui\jsModal( '',$vp));

   //   $card->addClickAction($vp,new \atk4\ui\Button('Изменить'));
      //

  }


//$card->setModel($user);
