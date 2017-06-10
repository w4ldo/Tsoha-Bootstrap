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
        $attributes = array(
            'taskname' => $params['taskname'],
            'description' => $params['description']
        );

        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) == 0) {
            $task->save();

            Redirect::to('/task/' . $task->id, array('message' => 'Task created'));
        } else {
            View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        $task = Task::find($id);
        View::make('task/edit.html', array('attributes' => $task));
    }

    // Pelin muokkaaminen (lomakkeen käsittely)
    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'taskname' => $params['taskname'],
            'description' => $params['description']
        );

        // Alustetaan Game-olio käyttäjän syöttämillä tiedoilla
        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) > 0) {
            View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
            $task->update();

            Redirect::to('/task/' . $task->id, array('message' => 'Task succesfully edited'));
        }
    }

    // Pelin poistaminen
    public static function destroy($id) {
        // Alustetaan Game-olio annetulla id:llä
        $task = new Task(array('id' => $id));
        // Kutsutaan Game-malliluokan metodia destroy, joka poistaa pelin sen id:llä
        $task->destroy();

        // Ohjataan käyttäjä pelien listaussivulle ilmoituksen kera
        Redirect::to('/task', array('message' => 'Task succesfully deleted'));
    }

}
