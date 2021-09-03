<?php
  require 'init.php';
  $card = $app->add(['Card','','big centered']);
    $user = new Users($db);
    $user->load($_GET['id']);
  $card->addContent(new \atk4\ui\Header($user['name']." ".$user['surname']));
  $rating = new \atk4\ui\View(['ui' => 'massive rating disabled']);
  $rating->js(true)->rating(['maxRating' => 5, 'initialRating' => round($user['rating'])]);
  //$r_label = $app->add(['Label',$slot['total_rating'],'circular massive']);
  $card->addContent($rating);

  $card->addImage($user['image']);
  $s2 = $card->addSection('О себе',$user,['dob','description','vk','inst',]);
  $s2->addClass('center aligned');
  $s2 = $card->addSection('Контакты',$user,['email','phone','country','city']);

  if($_SESSION['user_id']==$_GET['id']) {
      $vp = $app->add('VirtualPage');
      $vp->set(function ($vp) use ($user, $card) {
          $form = $vp->add('Form');
          $form->setModel($user, ['login', 'password', 'name', 'surname', 'dob', 'image', 'email', 'phone', 'country', 'city', 'gender', 'description', 'vk', 'inst']);
          $form->buttonSave->set('Сохранить');
          $form->onSubmit(function ($form) use ($card, $vp) {
              $form->model->save();

              return new \atk4\ui\jsExpression('document.location=""');
          });

      });

      $edit = new \atk4\ui\Button('Изменить');

      $edit->init();
      //$app->add($edit);
      $card->addButton($edit);
      $mod = new \atk4\ui\jsModal('', $vp);
      $edit->on('click', $mod);
  }


//$card->setModel($user);
