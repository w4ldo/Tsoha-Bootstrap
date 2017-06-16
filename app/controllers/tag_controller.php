<?php

class TagController extends BaseController {

    public static function create() {
        View::make('tag/new.html');
    }

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        $attributes = array(
            'tagname' => $params['tagname']
        );

        $tag = new Tag($attributes);
        $errors = $tag->errors();

        if (count($errors) == 0) {
            $tag->save();

            Redirect::to('/task', array('message' => 'Tag created'));
        } else {
            View::make('tag/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    public static function list_tasks($id) {
        $tag = Tag::find($id);
        $tasks = Task::all_with_tag($id);
        View::make('tag/list.html', array('tasks' => $tasks, 'tag' => $tag));
    }

}
