<?php
  require 'init.php';
  $card = $app->add(['Card','','big centered']);

  $card->addContent(new \atk4\ui\Header($current_user['name']." ".$current_user['surname']));
  $rating = new \atk4\ui\View(['ui' => 'massive rating disabled']);
  $rating->js(true)->rating(['maxRating' => 5, 'initialRating' => round($current_user['rating'])]);
  //$r_label = $app->add(['Label',$slot['total_rating'],'circular massive']);
  $card->addContent($rating);

  $card->addImage($current_user['image']);
  $s2 = $card->addSection('О себе',$current_user,['dob','description','vk','inst',]);
  $s2->addClass('center aligned');
  $s2 = $card->addSection('Контакты',$current_user,['email','phone','country','city']);

  $vp=$app->add('VirtualPage');
  $vp->set(function($vp)use($current_user,$card){
    $form = $vp->add('Form');
    $form->setModel($current_user);
    $form->buttonSave->set('Сохранить');
    $form->onSubmit(function($form)use($card,$vp){
       $form->model->save();

       return new \atk4\ui\jsExpression('document.location=""');
    });

  });

  $edit = new \atk4\ui\Button('Изменить');

  $edit->init();
  //$app->add($edit);
    $card->addButton($edit);
    $mod = new \atk4\ui\jsModal('',$vp);
  $edit->on('click',$mod);



//$card->setModel($current_user);
