<?php

class TaskController extends BaseController {

    public static function index() {
        $tasks = Task::all();
        View::make('task/index.html', array('tasks' => $tasks));
    }

    public static function create() {
        $priorities = Priority::all();
        View::make('task/new.html', array('priorities' => $priorities));
    }

    public static function show($id) {
        $task = Task::find($id);
        View::make('task/show.html', array('task' => $task));
    }

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        $priority = $params['priority'];
        $attributes = array(
            'owner_id' => $_SESSION['owner'],
            'priority_id' => $priority,
            'taskname' => $params['taskname'],
            'description' => $params['description']
        );

        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) == 0) {
            $task->save();

            Redirect::to('/task/' . $task->id, array('message' => 'Task created'));
        } else {
            $priorities = Priority::all();
            View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes, 'priorities' => $priorities));
        }
    }

    public static function edit($id) {
        $task = Task::find($id);
        $priorities = Priority::all();
        View::make('task/edit.html', array('attributes' => $task, 'priorities' => $priorities));
    }

    public static function update($id) {
        $params = $_POST;
        $priority = $params['priority'];
        $attributes = array(
            'id' => $id,
            'priority_id' => $priority,
            'taskname' => $params['taskname'],
            'description' => $params['description']
        );
        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) > 0) {
            $priorities = Priority::all();
            View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'priorities' => $priorities));
        } else {
            $task->update();
            Redirect::to('/task', array('message' => 'Task succesfully edited'));
        }
    }

    public static function destroy($id) {
        $task = new Task(array('id' => $id));
        $task->destroy();
        Redirect::to('/task', array('message' => 'Task succesfully deleted'));
    }

}
