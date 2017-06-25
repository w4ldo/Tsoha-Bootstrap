<?php

class Priority extends BaseModel {

    public $id, $priorityname;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Priority');
        $query->execute();
        $rows = $query->fetchAll();
        $tasks = array();
        foreach ($rows as $row) {
            $priorities[] = new Priority(array(
                'id' => $row['id'],
                'priorityname' => $row['priorityname']
            ));
        }

        return $priorities;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Priority WHERE id = :id LIMIT 1');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();

        if ($row) {
            $priority = new Priority(array(
                'id' => $row['id'],
                'priorityname' => $row['priorityname']
            ));

            return $priority;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Priority (priorityname) VALUES (:priorityname) RETURNING id');
        $query->execute(array('priorityname' => $this->priorityname));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Priority SET (priorityname) = (:priorityname) WHERE id=:id');
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        $query->bindValue(':priorityname', $this->priorityname, PDO::PARAM_STR);
        $query->execute();
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Priority WHERE id=:id');
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        $query->execute();
    }

    public function validate_priorityname() {
        $errors = array();
        if ($this->priorityname == '' || $this->priorityname == null) {
            $errors[] = 'Priority can\'t be empty';
        }
        if (strlen($this->priorityname) < 3) {
            $errors[] = 'Priority must be atleast 3 characters';
        }
        if (strlen($this->priorityname) > 50) {
            $errors[] = 'Priority can\'t exceed 400 characters';
        }
        return $errors;
    }

    public function errors() {
        $errors = array();

        $errors = array_merge($errors, $this->validate_priorityname());

        return $errors;
    }

}
