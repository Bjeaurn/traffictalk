<?php

class Security {

    // Hold an instance of the class
    //private static $id;

    // A private constructor; prevents direct creation of object
    private function __construct() {

    }

    /*
     * http://php.net/manual/en/book.filter.php
     * http://php.net/manual/en/filter.filters.sanitize.php
     * http://php.net/manual/en/filter.filters.validate.php
     * http://php.net/manual/en/filter.filters.flags.php
     */
    public static function sanitizeText($text){
        $text = filter_var($text,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //$text = filter_var($text,FILTER_SANITIZE_MAGIC_QUOTES);
        return $text;
    }

    public static function sanitizePost(){
        foreach ($_POST as $key => $value) {
            if(is_array($_POST[$key])) {
                foreach($_POST[$key] as $k=>$v) {
                    $_POST[$key][$k] = self::sanitizeText($_POST[$key][$k]);
                }
            } else {
                $_POST[$key] = self::sanitizeText($_POST[$key]);
            }
        }
    }

    /*
     * Database size 255 characters big
     * Use PASSWORD_DEFAULT so will use latest crypto at all times
     */
    public static function hashpassword($password) {
        if(!self::checkPasswordRequirements($password)){
            throw new Exception("Password doesn't meet requirements.");
        }
        return password_hash($password,PASSWORD_DEFAULT);
    }

    /*
     * Checks if password is correct
     * if correct: return True
     * if incorrect: return False
     */
    public static function checkpasswords($typedPassword, $hashedPassword) {
        // Verify stored hash against plain-text password
        return password_verify($typedPassword, $hashedPassword);
    }

    /*
     * Checks if password needs to be updated
     *
     * Check if a newer hashing algorithm is available
     * or the cost has changed
     *
     * Input: Hashed password from database
     */
    public static function checkNeedRehash($hashedPassword) {
        return password_needs_rehash($hashedPassword, PASSWORD_DEFAULT);
    }

    /*
     * Cryptographically secure hash
     * Makes SHA512 hash
     */
    public static function generateRandomHash(){
        $crypto_strong = false;
        $hash = hash("sha512",openssl_random_pseudo_bytes(1024,$crypto_strong));
        if(!$crypto_strong){
            throw new Exception("This system doens't generate cyptogrphicly strong hashes, please update your system.");
        }
        return $hash;
    }

    public static function validateEmail($email){
        if($email==null || $email==""){
            return false;
        }
        return $email==filter_var($email,FILTER_VALIDATE_EMAIL);
    }

    public static function sanitizeEmail($email){
        return strtolower(filter_var($email,FILTER_SANITIZE_EMAIL));
    }

    public static function sanitizeURL($url){
        $url = filter_var($url,FILTER_SANITIZE_URL);
        $url = preg_replace("/[^a-zA-Z0-9\/\.\_]/", "", $url);
        return $url;
    }

    public static function sanitizeFilename($filename){
        $filename = filter_var($filename,FILTER_SANITIZE_URL);
        $filename = preg_replace("/[^a-zA-Z0-9\.\_]/", "", $filename);
        return $filename;
    }

    public static function sanitizeURLFull($url){
        $url = filter_var($url,FILTER_SANITIZE_URL);
        $url = preg_replace("/[^a-zA-Z0-9\/\.\_\#\:]/", "", $url);
        return $url;
    }

    /*
     * Specifies needed length and character set of password
     *
     * Between Start -> ^
     * And End -> $
     * of the string there has to be at least one number -> (?=.*\d)
     * and at least one letter -> (?=.*[A-Za-z])
     * and it has to be a number, a letter or one of the following: !@#$%-.,+|?{}[]^/()*\~;:<>"'_`&<space>
     * and there have to be 8-40 characters -> {8,40}
     */
    public static function checkPasswordRequirements($password){
        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%\-\.\,\+\|\?\{\}\[\]\^\/\(\)\*\\\~\;\:\<\>\"\'\_\=\`\&\ ]{6,256}$/', $password)){
            return false;
        }
        return true;
    }

    // Prevent users to clone the instance
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

}

?>
