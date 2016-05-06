<?php

class Session {
    public static function check_credentials($user, $password)
    {
        global $dbh;

        $stmt = $dbh->prepare("SELECT password FROM user
            WHERE username = :user");

        $stmt->execute(array(
            'user'     => $user,
        ));

        $hash = $stmt->fetchColumn();

        if (password_verify($password, $hash)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $user;

            // create new session_id
            session_regenerate_id(true);

            return true;
        }

        return false;
    }

    public static function authenticated()
    {
        return ($_SESSION['logged_in'] === true);
    }

    public static function logout()
    {
        // destroy old session
        session_destroy();

        // immediately start a new one
        session_start();

        // create new session_id
        session_regenerate_id(true);
    }

    public function create_user($user, $password)
    {
        global $dbh;

        $stmt = $dbh->prepare("SELECT COUNT(*) FROM user
            WHERE username = :user");

        $stmt->execute(array(
            'user'     => $user
        ));

        if ($stmt->fetchColumn() == 0) {         // user does not yet exists, create it
            $stmt2 = $dbh->prepare("INSERT INTO user (username, password)
                VALUES (:user, :password)");

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt2->execute(array(
                'user'     => $user,
                'password' => $hash
            ));

            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $user;

            // create new session_id
            session_regenerate_id(true);
        } else {
            throw new Exception('user already exists!');
        }
    }
}
