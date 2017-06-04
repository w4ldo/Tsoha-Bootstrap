<?php

class TaskController extends BaseController {

    public static function index() {
        // Haetaan kaikki pelit tietokannasta
        $tasks = Task::all();
        // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('task/index.html', array('tasks' => $tasks));
    }
    
    public static function show($id) {
        // Haetaan kaikki pelit tietokannasta
        $task = Task::find($id);
        // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('task/show.html', array('task' => $task));
    }

}
