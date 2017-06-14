<?php

class BaseController {

    public static function get_user_logged_in() {
        // Katsotaan onko user-avain sessiossa
        if (isset($_SESSION['owner'])) {
            $owner_id = $_SESSION['owner'];
            // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
            $owner = Owner::find($owner_id);

            return $owner;
        }

        // Käyttäjä ei ole kirjautunut sisään
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['owner'])) {
            Redirect::to('/login', array('message' => 'You must be logged in!'));
        }
    }

}
