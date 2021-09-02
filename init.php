
<?php
session_start();
require 'vendor/autoload.php';
require 'lib/Slots.php';
require 'lib/SlotsUsers.php';
require 'lib/Users.php';
require 'lib/Cards.php';
require 'lib/UserCards.php';
//New app//
$app = new \atk4\ui\App('Vpiski.NET');
if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
     $db = new \atk4\data\Persistence\SQL($_ENV['CLEARDB_DATABASE_URL']);
 } else {
   $db = new \atk4\data\Persistence\SQL('mysql:dbname=party;localhost', 'MySite', '12345');
 }

///////////

//Layout//
$layout = $app->initLayout('Admin');
$layout->menu->addItem('test')->addClass('aligned right');
/*
$app->layout->template->del('Header');

//////////
$topmenu = $app->add(['Menu', 'fixed horizontal']);
$topmenu->addStyle('
 position: relative;
 bottom: 50px;');
//$topmenu2 = $app
//$topmenu->add(['ui'=>'right floated button blue']);
//$topmenu->add(['ui'=>'right floated button green']);
//$b_group = $topmenu->add(['ui'=>'horizontal buttons']);

if($_SERVER['PHP_SELF']=='/index.php'){
  //  $home = $topmenu->add(['ui'=>'button red'])->set('Домой')->link(['index']);
    $header = $app->layout->add([
        'Header',
        'Vpiski.NET',
        'icon'=>'bomb',
        'size'=>'huge',
        'aligned' => 'centered'
        ], 'Header');
        $header->addStyle('
         position: relative;
         top: 30px;');
    $header->link(['index']);
} else {
  $logo = $topmenu->add(['ui'=>'button red'])->set('Vpiski.NET')->link(['index']);
}
$admin = $topmenu->add(['ui'=>'button red'])->set('Админ')->link(['admin']);
if(isset($_SESSION['user_id'])){
  $current_user=new Users($db);
  $current_user->load($_SESSION['user_id']);
  $myprofile = $topmenu->add(['ui'=>'button blue'])->set('Мой профиль')->link(['profile','id'=>$current_user->id]);
  $attendedslots = $topmenu->add(['ui'=>'button green'])->set('Куда я иду')->link(['attendedslots']);
  $attendedslots = $topmenu->add(['ui'=>'button purple'])->set('Мои слоты')->link(['myslots']);//->on('click',new \atk4\ui\jsExpression('document.location="profile.php?id={$test}"'));
  $newslot = $topmenu->add(['ui'=>'button yellow'])->set('Новый слот')->link(['newslot']);
  $logout = $topmenu->add(['ui'=>'button red right aligned'])->set('Выйти')->link(['logout']);

}else{
   $signup = $topmenu->add(['ui'=>'button blue'])->set('Зарегистрироваться')->link(['register']);
//   $signin = $topmenu->add(['ui'=>'button green'])->set('Sign In');//->link(['login']);
   $but=$topmenu->addItem('Войти')->addClass('red');
   $popup=$app->layout->add(['Popup',$but]);
   $popup->setOption('position','bottom center');
     $popup->setHoverable();

     $popup->set(function($p) use($db){
       $user = new Users($db);
         $form = $p->add('Form');
       $form->setModel(new Users($db),['login','password']);
       $form->buttonSave->set('Sign in');
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
     });
}
*/
     /*
     $gmap = new \atk4\ui\Template('<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      #map {
        height: 100%;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyaaCYY8N0TZsKiz--wJ2pyC3edh3Ik2I&callback=initMap"
    async defer></script>
  </body>
</html>');
*/

  //$topmenu->add('Button');
//  $b_group->add(['ui'=>'button green']);
//  $b_group->add(['ui'=>'button blue']);
    /*->set('Sign In')->on('click', function($item)use($app){
    $i = $item->add(['ui'=>'segment bottom attached']);
    $i->js()->attr('src', $app->url('login.php'));
  });*/
  //->on('click',new \atk4\ui\jsExpression('document.location="login.php"'));


//DB Connection//

/*$t_s = $app->add(['ui'=>'top fixed segment']);
$b_group = $t_s->add(['ui'=>'right floated buttons']);
  $b_group->add(['ui'=>'button blue']);
    $b_group->add(['ui'=>'button green']);*/
//$topmenu2->add(['ui'=>'red inverted item'])->set('test')->link('index.php');
//$topmenu2->add(['ui'=>'red  inverted item'])->set('test')->link('index.php');
