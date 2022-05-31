<?php
  require 'init.php';
$user = new Users($db);
$form = $app->add('Form');
$form->setModel(new Users($db),['login','password']);
$form->buttonSave->set('Войти');
$form->onSubmit(function($form) use ($user) {
    $user->tryLoadBy('login',$form->model['login']);
    if (isset($user->id)){
        if ($user['password'] === $form->model['password']) {
            $_SESSION['user_id'] = $user->id;
            return new \atk4\ui\jsExpression('document.location=""');
        } else {
            $user->unload();
            $er = (new \atk4\ui\jsNotify('Wrong login/password'));
            $er->setColor('red');
            return $er;
        }
    } else{
        return new atk4\ui\jsNotify(['content' => 'No such user.', 'color' => 'red']);
    }
});
