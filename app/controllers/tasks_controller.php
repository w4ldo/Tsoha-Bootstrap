<?php

class TaskController extends BaseController {

    public static function index() {
        $tasks = Task::all();
        View::make('task/index.html', array('tasks' => $tasks));
    }

    public static function create() {
        $priorities = Priority::all();
        $tags = Tag::all();
        View::make('task/new.html', array('priorities' => $priorities, 'tags' => $tags));
    }

    public static function show($id) {
        $task = Task::find($id);
        View::make('task/show.html', array('task' => $task));
    }

    public static function store() {
        $params = $_POST;
        $priority = $params['priority'];
        if (array_key_exists("tags", $params)) {
            $tags = $params['tags'];
        } else {
            $tags[] = '';
        }

        $attributes = array(
            'owner_id' => $_SESSION['owner'],
            'priority_id' => $priority,
            'taskname' => $params['taskname'],
            'description' => $params['description']
        );
        foreach ($tags as $tag) {
            $attributes['tags'][] = $tag;
        }

        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) == 0) {
            $task->save();

            Redirect::to('/task/' . $task->id, array('message' => 'Task created'));
        } else {
            $priorities = Priority::all();
            $tags = Tag::all();
            View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes, 'priorities' => $priorities, 'tags' => $tags));
        }
    }

    public static function edit($id) {
        $task = Task::find($id);
        $tags = Tag::all();
        $priorities = Priority::all();
        View::make('task/edit.html', array('attributes' => $task, 'priorities' => $priorities, 'tags' => $tags));
    }

    public static function update($id) {
        $all_tags = Tag::all();
        $params = $_POST;
        $priority = $params['priority'];
        if (array_key_exists("tags", $params)) {
            $tags = $params['tags'];
        } else {
            $tags[] = '';
        }
        $attributes = array(
            'id' => $id,
            'priority_id' => $priority,
            'taskname' => $params['taskname'],
            'description' => $params['description']
        );
        foreach ($tags as $tag) {
            $attributes['tags'][] = $tag;
        }
        $task = new Task($attributes);
        $errors = $task->errors();

        if (count($errors) > 0) {
            $priorities = Priority::all();
            View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'priorities' => $priorities, $priorities, 'tags' => $all_tags));
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
