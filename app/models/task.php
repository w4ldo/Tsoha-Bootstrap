<?php

class Task extends BaseModel {

    public $id, $owner_id, $priority_id, $priorityname, $taskname, $description, $tags;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT task.id, task.owner_id, task.taskname, '
                . 'task.description, priority.priorityname FROM Task LEFT JOIN Priority ON '
                . 'Task.priority_id = Priority.id ORDER BY task.id;');
        $query->execute();
        $rows = $query->fetchAll();
        $tasks = array();
        foreach ($rows as $row) {
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
                'priorityname' => $row['priorityname'],
                'taskname' => $row['taskname'],
                'description' => $row['description']
            ));
        }

        return $tasks;
    }

    public static function all_with_tag($id) {
        $query = DB::connection()->prepare('SELECT task.id, task.owner_id, task.taskname, '
                . 'task.description, priority.priorityname FROM Task, TaskTag, Tag, '
                . 'Priority WHERE task.priority_id = priority.id AND task.id = '
                . 'tasktag.task_id AND tag.id = tasktag.tag_id AND tag.id = :id ORDER BY task.id;');
        $query->bindValue(':id', $id);
        $query->execute();
        $rows = $query->fetchAll();
        $tasks = array();
        foreach ($rows as $row) {
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
                'priorityname' => $row['priorityname'],
                'taskname' => $row['taskname'],
                'description' => $row['description']
            ));
        }

        return $tasks;
    }

    public static function tags($id) {
        $query = DB::connection()->prepare('SELECT tag.tagname, tag.id FROM Task, Tag, TaskTag '
                . 'WHERE task.id = tasktag.task_id AND tag.id = tasktag.tag_id AND task.id = :id');
        $query->bindValue(':id', $id);
        $query->execute();
        $rows = $query->fetchAll();
        $tags = array();
        foreach ($rows as $row) {
            $tags[] = new Tag(array(
                'id' => $row['id'],
                'tagname' => $row['tagname']
            ));
        }

        return $tags;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT task.id, task.owner_id, task.taskname, '
                . 'task.description, priority.priorityname FROM Task LEFT JOIN Priority ON '
                . 'Task.priority_id = Priority.id'
                . ' WHERE task.id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();

        if ($row) {
            $task = new Task(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
                'priorityname' => $row['priorityname'],
                'taskname' => $row['taskname'],
                'description' => $row['description']
            ));

            return $task;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (:owner_id, :priority_id, :taskname, :description) RETURNING id');
        $query->execute(array('owner_id' => $this->owner_id, 'priority_id' => $this->priority_id, 'taskname' => $this->taskname, 'description' => $this->description));
        $row = $query->fetch();
        $this->id = $row['id'];
        if (!in_array("", $this->tags)) {
            foreach ($this->tags as $tag) {
                $query = DB::connection()->prepare('INSERT INTO TaskTag (tag_id, task_id) VALUES (:tag_id, :task_id)');
                $query->execute(array('tag_id' => $tag, 'task_id' => $this->id));
            }
        }
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Task SET (priority_id, taskname, description) = (:priority_id, :taskname, :description) WHERE id = :id');
        $query->execute(array('priority_id' => $this->priority_id, 'taskname' => $this->taskname, 'description' => $this->description, 'id' => $this->id));
        $query = DB::connection()->prepare('DELETE FROM TaskTag WHERE task_id = :task_id');
        $query->execute(array('task_id' => $this->id));
        if (!in_array("", $this->tags)) {
            foreach ($this->tags as $tag) {
                $query = DB::connection()->prepare('INSERT INTO TaskTag (tag_id, task_id) VALUES (:tag_id, :task_id)');
                $query->execute(array('tag_id' => $tag, 'task_id' => $this->id));
            }
        }
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Task WHERE id=:id');
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        $query->execute();
    }

    public function validate_taskname() {
        $errors = array();
        if ($this->taskname == '' || $this->taskname == null) {
            $errors[] = 'Name can\'t be empty';
        }
        if (strlen($this->taskname) < 3) {
            $errors[] = 'Name must be atleast 3 characters';
        }
        if (strlen($this->taskname) > 50) {
            $errors[] = 'Name can\'t exceed 50 characters';
        }
        return $errors;
    }

    public function validate_description() {
        $errors = array();
        if (strlen($this->description) > 400) {
            $errors[] = 'Description can\'t exceed 400 characters';
        }

        return $errors;
    }

    public function errors() {
        $errors = array();

        $errors = array_merge($errors, $this->validate_taskname());
        $errors = array_merge($errors, $this->validate_description());

        return $errors;
    }

}
