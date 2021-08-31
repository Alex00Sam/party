<?php
  require 'init.php';
//    $app->add(['Button','Homepage','icon'=>'undo'])->link('index.php');

  $slot = new Slots($db);
  $slots_id = $app->stickyGet('id');
  $slot->load($slots_id);
  $creatoruser=new Users($db);
  $creatoruser->load($slot['creator_id']);
/*
  $columns=$app->add('Columns');
  $row1 = $columns
  */
  $segment = $app->add(['ui'=>'segment']);
  $segment->add(['Header',$slot['name']]);
  $cr = $segment->add(new \atk4\ui\View('Организатор: '.$creatoruser['name'].' '.$creatoruser['surname']));
  //$cr->addClass('red');
  $app->add(['ui'=>'divider']);
  $columns = $app->add('Columns');
  $col1 = $columns->addColumn(12);
  $col2 = $columns->addColumn(4);
  $img = $col1->add(['Image',$slot['image'],'rounded']);
  $img->addStyle('width:50%;');
  $app->add(['ui'=>'hidden divider']);
  $app->add(['Text',$slot['description']]);
  $app->add(['ui'=>'hidden divider']);
  $rating = new \atk4\ui\View(['ui' => 'massive rating disabled']);
  $rating->js(true)->rating(['maxRating' => 5, 'initialRating' => round($slot['total_rating'])]);


  $rr = $app->add($rating);

  $r_label = $app->add(['Label',round($slot['total_rating'],2),'circular massive']);

  $mid = $slot->ref('SlotsUsers');
  /*
  $i=0;
  foreach($mid as $a) {
    $i++;
  }*/

  $label = $app->add(['Button',$slot['total'],'big','icon'=> 'users']);
  $popup=$app->layout->add(['Popup',$label]);
  $popup->setOption('position','top center');
    $popup->setHoverable();

    $popup->set(function($p) use($db,$slot){
      $mid = $slot->ref('SlotsUsers');

      foreach($mid as $m){
        $u = new Users($db);
        $u->load($m['users_id']);
      //  $p->add(new UserCards($u));
        $p->add(['Button',$u['name'],'image'=>$u['image']]);
      }
    });
  $join=$app->add(['Button','Вступить']);
  if(!isset($_SESSION['user_id'])){
    $join->addClass('disabled');

  } else{
      if(!(($mid->tryLoadBy('users_id',$_SESSION['user_id']))->loaded())) {
        $join->on('click',function($join)use($db,$slots_id,$label,$current_user,$rr,$r_label,$rating,$popup){
          $su=new SlotsUsers($db);
          $su['users_id']=$_SESSION['user_id'];
          $su['slots_id']=$slots_id;
          $su['slots_rating']=$current_user['rating'];
          /*if($current_user['gender']=="Мужской") $slot['male']++;
          else $slot['female']++;
          $slot->save();*/
          $su->save();
        //  $label->jsReload();

         return [$rating->jsReload(),$rr->jsReload(),$r_label->jsReload(),$label->jsReload(),$popup->jsReload(),$join->text('Вы вступили')];//

        });
      } else{
        $join->set('Вы вступили');
        $join->on('click',function($join)use($mid,$label,$rr,$r_label,$rating,$popup){
          $mid->loadBy('users_id',$_SESSION['user_id'])->delete();
        //  $label->jsReload();
        /*if($current_user['gender']=="Мужской") $slot['male']--;
        else $slot['female']--;
        $slot->save();*/
          return [$rating->jsReload(),$rr->jsReload(),$r_label->jsReload(),$label->jsReload(),$popup->jsReload(),$join->text('Вступить')];
        });
      }
    }

    if($slot['creator_id']==$_SESSION['user_id']){
      $join->addClass('disabled');


      $vp = $app->add('VirtualPage');
      $vp->set(function ($page) use($slot) {
          $form = $page->add('Form');
          $form->setModel($slot,['name','image','description','date','time','place','is_private','gender']);
          $form->onSubmit(function($f){
            $f->model->save();
            return new \atk4\ui\jsExpression('document.location=""');
          });
          $page->add(['ui'=>'hidden divider']);

          $del = $page->add(['Button','Удалить слот','negative basic']);
          $popup = $page->add(['Popup',$del]);
          $popup->set(function ($page2) use($slot,$del) {
                $page2->add(['Header','Вы уверены?']);
                $yes = $page2->add(['Button','Удалить','red']);
                $yes->on('click',function($b)use($slot){
                  $slot->delete();
                  return new \atk4\ui\jsExpression('document.location="index.php"');
                });
          });
      });
      $ch = $app->add(['Button','Редактировать слот']);
      $ch->on('click',new \atk4\ui\jsModal('Редактировать слот', $vp));
    }
    $col2->add(['Label','Место:','icon'=>'map marker alternate']);
    $col2->add(['Header',$slot['place']]);
    if($slot['showmap']) {
      $map = new \atk4\ui\View(['template' => new \atk4\ui\Template('    <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q='.$slot['place'].'&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style></div>')]);
      $col2->add($map);
    }
    $col2->add(['Label','Дата:','icon'=>'calendar alternate outline']);
  //  $col2->add(['Header',date($slot['date'])]);
    $col2->add(['Label','test','image'=>$slot['image']]);

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
