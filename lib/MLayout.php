<?php
/**
 * An Admin layout with enhance left menu.
 * This layout use jQuery plugin atk-sidenav.plugin.js
 *  Default value for this plugin is set for Maestro layout using maestro-sidenav.html template.
 *  Note that it is possible to change these default value if another template is use.
 */


use atk4\ui\Header;
use atk4\ui\Icon;
use atk4\ui\Item;
use atk4\ui\jQuery;
use atk4\ui\Menu;

class MLayout extends \atk4\ui\Layout\Maestro
{
    public $menuTemplate = 'layout/maestro-sidenav.html';

    public function init(): void
    {
        \atk4\ui\Layout\Generic::init();

        if ($this->menu === null) {
            $this->menu = Menu::addTo($this, ['inverted fixed horizontal', 'element' => 'header'], ['TopMenu']);
            if(isset($_SESSION['user_id'])){
                $this->burger = $this->menu->addItem(['class' => ['icon']]);
                $this->burger->on('click', [
                    (new jQuery('.atk-sidenav'))->toggleClass('visible'),
                    (new jQuery('body'))->toggleClass('atk-sidenav-visible'),
                ]);
                Icon::addTo($this->burger, ['content']);
            }
            //Header::addTo($this->menu, [$this->app->title, 'size' => 4])->link(['index']);
            $this->menu->addItem($this->app->title,['index']);

        }

        if ($this->menuRight === null) {
            $this->menuRight = Menu::addTo($this->menu, ['ui' => false], ['RightMenu'])
                ->addClass('right menu')->removeClass('item');
        }

        if ($this->menuLeft === null) {
            $this->menuLeft = Menu::addTo($this, ['ui' => 'atk-sidenav-content'], ['LeftMenu']);
        }
        if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
            $db = new \atk4\data\Persistence\SQL($_ENV['CLEARDB_DATABASE_URL']);
        } else {
            $db = new \atk4\data\Persistence\SQL('mysql:dbname=party;localhost', 'MySite', '12345');
        }
        if($_SESSION['user_id']==1) $this->menu->addItem('Admin',['admin']);
        if(isset($_SESSION['user_id'])){
            $this->menuRight->addItem('Выйти',['logout']);
            $this->menuLeft->addItem('Мой профиль',['profile','id'=>$_SESSION['user_id']]);
            $this->menuLeft->addItem('Куда я иду',['myslots']);
            $this->menuLeft->addItem('Мои мероприятия',['myslots']);
            $this->menuLeft->addItem('Добавить мероприятие',['newslot']);
        } else{
            $login = $this->menuRight->addItem('Войти');
            $popup=$this->add(['Popup',$login]);
            $popup->setOption('position','bottom center');
            $popup->setHoverable();
            $popup->set(function($p) use($db){
                $user = new Users($db);
                $form = $p->add('Form');
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
            });
            $this->menuRight->addItem('Зарегистрироваться',['register']);
        }
        //$this->menuLeft->addItem();
    }

    public function addMenuGroup($seed): Menu
    {
        $gr = $this->menuLeft->addGroup($seed, $this->menuTemplate)->addClass('atk-maestro-sidenav');
        $gr->removeClass('item');

        return $gr;
    }

    public function addMenuItem($name, $action = null, $group = null): Item
    {
        $i = parent::addMenuItem($name, $action, $group);
        if (!$group) {
            $i->addClass('atk-maestro-sidenav');
        }

        return $i;
    }

    /**
     * {@inheritdoc}
     */
    public function renderView()
    {

        \atk4\ui\Layout\Generic::renderView();
        if (isset($_SESSION['user_id'])) {
            $this->menuLeft->js(true)->parent()->addClass('visible');
        }
        $js = (new jQuery('.atk-maestro-sidenav'))->atkSidenav();

        $this->js(true, $js);
    }
}
