<?php
Atomik::set(array (
  'app' => 
  array (
    'layout' => '_layout',
    'default_action' => 'index',
    'views' => 
    array (
      'file_extension' => '.phtml',
    ),
  ),
  'atomik' => 
  array (
    'start_session' => true,
    'class_autoload' => true,
    'trigger' => 'action',
    'catch_errors' => true,
    'display_errors' => true,
    'debug' => false,
  ),
  'styles' => 
  array (
    0 => 'assets/css/main.css',
  ),
  'plugins' => 
  array (
    0 => 'Db',
  ),
  'scripts' => 
  array (
  ),
)
);
Atomik::set('plugins/Db', array('dsn'  => 'pgsql:host=127.0.0.1;dbname=uroskanta', 'username'=>'postgres','password'  => 'burana12'));
