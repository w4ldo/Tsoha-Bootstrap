<?php

class PriorityController extends BaseController {

    public static function create() {
        View::make('priority/new.html');
    }

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        $attributes = array(
            'priorityname' => $params['priorityname']
        );

        $priority = new Priority($attributes);
        $errors = $priority->errors();

        if (count($errors) == 0) {
            $priority->save();

            Redirect::to('/task', array('message' => 'Priority created'));
        } else {
            View::make('priority/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
