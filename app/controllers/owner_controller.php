<?php

class OwnerController extends BaseController{
  public static function login(){
      View::make('owner/login.html');
  }
  public static function handle_login(){
    $params = $_POST;

    $owner = Owner::authenticate($params['username'], $params['password']);

    if(!$user){
      View::make('owner/login.html', array('error' => 'Authentication failed', 'username' => $params['username']));
    }else{
      $_SESSION['owner'] = $owner->id;

      Redirect::to('/', array('message' => 'Welcome back' . $owner->username . '!'));
    }
  }
}
