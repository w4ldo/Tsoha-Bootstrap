<?php

class Tag extends BaseModel {

    public $id, $tagname;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tag');
        $query->execute();
        $rows = $query->fetchAll();
        $tasks = array();
        foreach ($rows as $row) {
            $tags[] = new Tag(array(
                'id' => $row['id'],
                'tagname' => $row['tagname']
            ));
        }

        return $tags;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tag WHERE id = :id LIMIT 1');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();

        if ($row) {
            $tag = new Tag(array(
                'id' => $row['id'],
                'tagname' => $row['tagname']
            ));

            return $tag;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tag (tagname) VALUES (:tagname) RETURNING id');
        $query->execute(array('tagname' => $this->tagname));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Tag SET (tagname) = (:tagname) WHERE id=:id');
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        $query->bindValue(':tagname', $this->tagname, PDO::PARAM_STR);
        $query->execute();
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Tag WHERE id=:id');
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        $query->execute();
    }

    public function validate_tagname() {
        $errors = array();
        if ($this->tagname == '' || $this->tagname == null) {
            $errors[] = 'Tag can\'t be empty';
        }
        if (strlen($this->tagname) < 3) {
            $errors[] = 'Tag must be atleast 3 characters';
        }
        if (strlen($this->tagname) > 50) {
            $errors[] = 'Tag can\'t exceed 50 characters';
        }
        return $errors;
    }

    public function errors() {
        $errors = array();

        $errors = array_merge($errors, $this->validate_tagname());

        return $errors;
    }

}
