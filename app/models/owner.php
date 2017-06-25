<?php

class Owner extends BaseModel {

    public $id, $username, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Owner');
        $query->execute();
        $rows = $query->fetchAll();
        $owners = array();
        foreach ($rows as $row) {
            $owners[] = new Owner(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
        }

        return $owners;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Owner WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $owner = new Owner(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));

            return $owner;
        }

        return null;
    }

    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Owner WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();

        if ($row) {
            $owner = new Owner(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));

            return $owner;
        } else {
            return null;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Owner (username, password) VALUES (:username, :password) RETURNING id');
        $query->execute(array('username' => $this->username, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_username() {
        $errors = array();
        if ($this->username == '' || $this->username == null) {
            $errors[] = 'Name can\'t be empty';
        }
        if (strlen($this->username) < 3) {
            $errors[] = 'Name must be atleast 3 characters';
        }
        if (strlen($this->username) > 50) {
            $errors[] = 'Name can\'t exceed 50 characters';
        }
        return $errors;
    }

    public function validate_password() {
        $errors = array();
        if ($this->password == '' || $this->password == null) {
            $errors[] = 'Password can\'t be empty';
        }
        if (strlen($this->password) < 3) {
            $errors[] = 'Password must be atleast 3 characters';
        }
        if (strlen($this->password) > 50) {
            $errors[] = 'Password can\'t exceed 50 characters';
        }
        return $errors;
    }

    public function errors() {
        $errors = array();

        $errors = array_merge($errors, $this->validate_username());
        $errors = array_merge($errors, $this->validate_password());

        return $errors;
    }

}
