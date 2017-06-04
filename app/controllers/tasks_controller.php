<?php

class TaskController extends BaseController {

    public static function index() {
        // Haetaan kaikki pelit tietokannasta
        $tasks = Task::all();
        // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('task/index.html', array('tasks' => $tasks));
    }

    public static function create() {
        View::make('task/new.html');
    }
    
    public static function show($id) {
        // Haetaan kaikki pelit tietokannasta
        $task = Task::find($id);
        // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('task/show.html', array('task' => $task));
    }

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla
        $task = new Task(array(
            'taskname' => $params['taskname'],
            'description' => $params['description']
        ));

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $task->save();

        // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/task/' . $task->id, array('message' => 'Task added!'));
    }

}
