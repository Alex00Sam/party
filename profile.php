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

  if($current_user->id==$viewuser->id) {
      $vp = $app->add('VirtualPage');
      $vp->set(function ($vp) use ($viewuser, $card) {
          $form = $vp->add('Form');
          $form->setModel($viewuser, ['login', 'password', 'name', 'surname', 'dob', 'image', 'email', 'phone', 'country', 'city', 'gender', 'description', 'vk', 'inst']);
          $form->buttonSave->set('Сохранить');
          $form->onSubmit(function ($form) use ($card, $vp) {
              $form->model->save();

              return new \atk4\ui\jsExpression('document.location=""');
          });

      });

      $edit = new \atk4\ui\Button('Изменить');
      $edit->init();
      $edit->on('click', $vp);
      //$app->add($edit);
      $card->addButton($edit);
      //$mod = new \atk4\ui\jsModal('', $vp);

  }


//$card->setModel($user);
