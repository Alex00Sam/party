<?php
require 'init.php';
$user = new Users($db);
$w = $app->add('Wizard');





$w->addStep('Имя пользователя и пароль',function($t)use($db,$user){
//  $form =$t->add('Form');
  $form =$t->add('Form');
  $form -> setModel($user,['login','password']);
  $form->onSubmit(function($f)use($t){
  //  var_dump();
    $t->memorize('model1',$f->model->get());
    return $t->jsNext();
  });
});

$w->addStep('О себе',function($t)use($db,$user){
  $f =$t->add('Form');
  $f -> setModel($user,['name','surname',
      'email','phone','category',
      //'country','city','gender','description','vk','inst','image',
      'dob']);
  //$m1 = $t->recall('model1');
  //$form->model->set('login',$m1['login']);
  //$form->model->set('password',$m1['password']);
//  $f->buttonSave = $t->buttonFinish;
  $f->onSubmit(function($f)use($t,$user){
//  $t->buttonFinish->on('click',function($b)use($f,$t,$user){
  /*  $t->memorize('model2',$form2->model->data);
    return $t->jsNext();
  });*/
//  $form2->buttonSave->addClass('visible');
//  $form2->addHook('submit',function($f)use($t,$user){

  //  $t->memorize('model2',$form2->model->get());
  //  $f->ajaxSubmit();
    $user->set('login',($t->recall('model1'))['login']);
    $user->set('password',($t->recall('model1'))['password']);
    $user->set('name',$f->model['name']);
    $user->set('surname',$f->model['surname']);
    $user->set('email',$f->model['email']);
    $user->set('phone',$f->model['phone']);
 //   $user->set('category',$f->model['category']);
 //   $user->set('city',$f->model['city']);
   // $user->set('gender',$f->model['gender']);
  //  $user->set('description',$f->model['description']);
  //  $user->set('image',$f->model['image']);
  //  $user->set('rating',2.5);
   // $user->set('vk',$f->model['vk']);
    //$user->set('inst',$f->model['inst']);
    $user->set('dob',$f->model['dob']);
    $user->save();
    $_SESSION['user_id']=$user->id;
   return $t->jsNext();
  });
});

$w->addStep('Регистрация завершена!',function($t)use($db,$user){

  $t->buttonFinish->set('На главную');
    $t->buttonFinish->on('click',function($b){

      return new \atk4\ui\jsExpression('document.location="index.php"');
    });
});

$w->addFinish(function($t)use($app){
//  var_dump($t->recall('model2'));
return new \atk4\ui\jsExpression('document.location="index.php"');
});
