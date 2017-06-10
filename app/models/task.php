<?php

class Task extends BaseModel {

    public $id, $owner_id, $taskname, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Task');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $tasks = array();

        // Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
                'taskname' => $row['taskname'],
                'description' => $row['description']
            ));
        }

        return $tasks;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $task = new Task(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
                'taskname' => $row['taskname'],
                'description' => $row['description']
            ));

            return $task;
        }

        return null;
    }

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Task (taskname, description) VALUES (:taskname, :description) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('taskname' => $this->taskname, 'description' => $this->description));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Task (taskname, description) VALUES (:taskname, :description)');
        $query->execute(array('taskname' => $this->taskname, 'description' => $this->description));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE Task (taskname, description) VALUES (:taskname, :description)');
        $query->execute(array('taskname' => $this->taskname, 'description' => $this->description));
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
            $errors[] = 'Name can\'t exceed 400 characters';
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
