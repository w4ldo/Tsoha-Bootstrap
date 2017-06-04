<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        $owner = Owner::find(1);
        $owners = Owner::all();
        $task = Task::find(1);
        $tasks = Task::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($owner);
        Kint::dump($owners);
        Kint::dump($task);
        Kint::dump($tasks);
    }

    public static function task_edit() {
        View::make('suunnitelmat/task_edit.html');
    }

    public static function task_list() {
        View::make('suunnitelmat/task_list.html');
    }

    public static function task_show() {
        View::make('suunnitelmat/task_show.html');
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

}
