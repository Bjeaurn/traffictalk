<?php
class User extends Model {

    public $id, $name, $level;

    public function FillObject($row) {
      parent::FillObject($row);
      $this->level = $row['UserLevel'];
    }

    public static function getUser() {
        $user = new User;
        if(self::isLoggedIn()) {
            $user = self::findByUserId(self::isLoggedIn());
        }
        return $user;
    }

    public static function isLoggedIn() {
        // No route = authentication?
        $token = apache_request_headers()["Authorization"];
        if(!$token) {
            API::error("No authentication token", 401);
            die();
        } else {
            $user = Authentication::Verify($token);
            $session = Session::start();
            return $session->Get('UserID');
        }
    }

    public static function checkLoggedIn() {
        if(self::isLoggedIn()) {
            return self::findByUserId(self::isLoggedIn());
        }
    }

    public static function Login($name, $password) {
        $name = Security::sanitizeText($name);
        $db = DatabasePDO::start();
        $result = $db->prepare("SELECT * FROM users WHERE UserName = :name OR UserEmail = :email LIMIT 1");
        $result->bindParam(":name", $name);
        $result->bindParam(":email", $name);
        $result->execute();
        if($result->rowCount() == 1) {
            $row = $result->fetch();
            if(Security::checkpasswords($password, $row['UserHash'])) {
                $session = Session::start();

                $user = new User;
                $user->FillObject($row);

                $session->Set($user->id, 'UserID');

                return $user;
            }
        }
        return false;
    }

    public static function Logout() {
        $session = Session::start();
        $session->Delete('UserID');
        return;
    }

    public static function Register($name, $email, $password) {
        $name = Security::sanitizeText($name);
        $email = Security::sanitizeEmail($email);
        $password = Security::hashpassword($password);
        $db = DatabasePDO::start();
        $result = $db->prepare("INSERT INTO users (UserName, UserEmail, UserHash) VALUES (:name, :email, :hash)");
        $result->bindParam(":name", $name);
        $result->bindParam(":email", $email);
        $result->bindParam(":hash", $password);
        $result->execute();
        $user = new User;
        $user->id = $db->lastInsertId();
        $user->name = $name;
        $session = Session::start();
        $session->Set($user->id, 'UserID');
        return $user;
    }

    public static function NameEmailExists($name, $email) {
        $db = DatabasePDO::start();
        $result = $db->prepare("SELECT * FROM users WHERE UserName = :name OR UserEmail = :email");
        $result->bindParam(":name", $name);
        $result->bindParam(":email", $email);
        $result->execute();
        if($result->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public static function findByUserId($id) {
        $db = DatabasePDO::start();
        $result = $db->prepare("SELECT * FROM users WHERE UserID = :userID LIMIT 1");
        $result->bindParam(":userID", $id);
        $result->execute();
        if($result->rowCount()==1) {
            $row = $result->fetch();
            $user = new User;
            $user->FillObject($row);
            return $user;
        }
        return false;
    }
}
