<?php
  require 'init.php';
//    $app->add(['Button','Homepage','icon'=>'undo'])->link('index.php');

  $slot = new Slots($db);
  $slots_id = $app->stickyGet('id');
  $slot->load($slots_id);
  $creatoruser=new Users($db);
  $creatoruser->load($slot['creator_id']);
  $app->add(['Header',$slot['name']]);
  $cr = $app->add(new \atk4\ui\View('Организатор: '.$creatoruser['name'].' '.$creatoruser['surname']));
  //$cr->addClass('red');
  $img = $app->add(['Image',$slot['image'],'rounded']);
  $app->add(['ui'=>'hidden divider']);
  $app->add(['Text',$slot['description']]);
  $app->add(['ui'=>'hidden divider']);
  $rating = new \atk4\ui\View(['ui' => 'massive rating disabled']);
  $rating->js(true)->rating(['maxRating' => 5, 'initialRating' => round($slot['total_rating'])]);


  $rr = $app->add($rating);

  $r_label = $app->add(['Label',$slot['total_rating'],'circular massive']);

  $mid = $slot->ref('SlotsUsers');
  /*
  $i=0;
  foreach($mid as $a) {
    $i++;
  }*/

  $label = $app->add(['Label',$slot['total'],'massive','icon'=> 'users']);
  $join=$app->add(['Button','Вступить']);
  if(!isset($_SESSION['user_id'])){
    $join->addClass('disabled');

  } else{
      if(!(($mid->tryLoadBy('users_id',$_SESSION['user_id']))->loaded())) {
        $join->on('click',function($join)use($db,$slots_id,$slot,$label,$current_user,$rr,$r_label,$rating){
          $su=new SlotsUsers($db);
          $su['users_id']=$_SESSION['user_id'];
          $su['slots_id']=$slots_id;
          $su['slots_rating']=$current_user['rating'];
          /*if($current_user['gender']=="Мужской") $slot['male']++;
          else $slot['female']++;
          $slot->save();*/
          $su->save();
        //  $label->jsReload();

         return [$rating->jsReload(),$rr->jsReload(),$r_label->jsReload(),$label->jsReload(),$join->text('Вы вступили')];//

        });
      } else{
        $join->set('Вы вступили');
        $join->on('click',function($join)use($mid,$label,$rr,$r_label,$rating,$slot,$current_user){
          $mid->loadBy('users_id',$_SESSION['user_id'])->delete();
        //  $label->jsReload();
        /*if($current_user['gender']=="Мужской") $slot['male']--;
        else $slot['female']--;
        $slot->save();*/
          return [$rating->jsReload(),$rr->jsReload(),$r_label->jsReload(),$label->jsReload(),$join->text('Вступить')];
        });
      }
    }

    if($slot['creator_id']==$_SESSION['user_id']){
      $join->addClass('disabled');
      $del = $app->add(['Button','Удалить слот']);

      $del->on('click',function($b)use($slot){
        $slot->delete();
        return new \atk4\ui\jsExpression('document.location="index.php"');
      });

      $vp = $app->add('VirtualPage');
      $vp->set(function ($page) use ($slot) {
          $form = $page->add('Form')->setModel($slot);
          $form->onSubmit(function($f){
            $form->model->save();
          });
      });
      $ch = $app->add(['Button','Редактировать слот']);
      $ch->on('click',new \atk4\ui\jsModal('Редактировать слот', $vp));
    }


    //var_dump($mid);
      /*  $popup=$app->add(['Popup',$join]);
        $popup->setHoverable(true);

        $popup->set(function($p) use($db){
          $user = new Users($db);
            $form = $p->add('Form');
          $form->setModel($user,['login','password']);
          $form->buttonSave->set('Sign in');
          $form->onSubmit(function($form) use ($user) {
            $user->tryLoadBy('login',$form->model['login']);
            if (isset($user->id)){
            if ($user['password'] == $form->model['password']) {
              $_SESSION['user_id'] = $user->id;
              return new \atk4\ui\jsExpression('document.location="index.php"');
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
        });*/


      /*$list = $app->add(['Lister','defaultTemplate'=>'lister.html']);
      $list->setModel($attended);
      $form = $app->add('Form');
      $form->addField('gender', ['Radio'], ['enum'=>['Мужской','Женский','Не указано']]);
      $form->addField('male',['disabled' => true])->set('ss');
     $form->addField('sum',['disabled' => true]);//->set($this['male']+$this['female']);
     $slider = new \atk4\ui\View(['ui' => 'slider']);
      $slider->js(true)->slider();
      $app->add($slider);

    */
