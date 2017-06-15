<?php

class Task extends BaseModel {

    public $id, $owner_id, $priority_id, $priorityname, $taskname, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT task.id, task.owner_id, task.taskname, '
                . 'task.description, priority.priorityname FROM Task LEFT JOIN Priority ON '
                . 'Task.priority_id = Priority.id ORDER BY task.id;');
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $tasks = array();
        // $owner = self::get_user_logged_in;
        // Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            //          if ('id' == $owner . id) {
            // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
                'priorityname' => $row['priorityname'],
                'taskname' => $row['taskname'],
                'description' => $row['description']
            ));
            //   }
        }

        return $tasks;
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
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Task SET (priority_id, taskname, description) = (:priority_id, :taskname, :description) WHERE id=:id');
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        $query->bindValue(':priority_id', $this->priority_id, PDO::PARAM_INT);
        $query->bindValue(':taskname', $this->taskname, PDO::PARAM_STR);
        $query->bindValue(':description', $this->description, PDO::PARAM_STR);
        $query->execute();
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
