<?php

class OwnerController extends BaseController {

    public static function login() {
        View::make('owner/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $owner = Owner::authenticate($params['username'], $params['password']);

        if (!$owner) {
            View::make('owner/login.html', array('message' => 'Authentication failed', 'username' => $params['username']));
        } else {
            $_SESSION['owner'] = $owner->id;

            Redirect::to('/', array('message' => 'Welcome back ' . $owner->username . '!'));
        }
    }

    public static function logout() {
        $_SESSION['owner'] = null;
        Redirect::to('/login', array('message' => 'Succesfully logged out!'));
    }

    public static function signup() {
        View::make('owner/new.html');
    }

    public static function handle_signup() {
        $params = $_POST;

        $attributes = array(
            'username' => $params['username'],
            'password' => $params['password']
        );

        $owner = new Owner($attributes);
        $errors = $owner->errors();
        if (count($errors) == 0) {
            $owner->save();

            Redirect::to('/login', array('message' => 'Sign up complete'));
        } else {
            View::make('owner/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
