<?php

class Priority extends BaseModel {

    public $id, $priorityname;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Priority');
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $tasks = array();
        // $owner = self::get_user_logged_in;
        // Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            //          if ('id' == $owner . id) {
            // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
            $priorities[] = new Priority(array(
                'id' => $row['id'],
                'priorityname' => $row['priorityname']
            ));
            //   }
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
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Priority (priorityname) VALUES (:priorityname) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('priorityname' => $this->priorityname));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
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
