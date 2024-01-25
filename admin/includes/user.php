<?php


    class User extends Db_Object{

        protected static $dbTable = "users";
        protected static $dbTableFields = array('username','password','firstName','lastName');
        public $id;
        public $username;
        public $password;
        public $firstName;
        public $lastName;

        

    public static function verifyUser($username, $password){
        global $database;
        $username = $database ->escapeString($username);
        $password = $database ->escapeString($password);

        $sql = "SELECT * FROM " . self::$dbTable . " WHERE ";
        $sql .= "username = '{$username}'";
        $sql .= "AND password = '{$password}' LIMIT 1";

        $resultArray = self::findByQuery($sql);
        return !empty($resultArray) ? array_shift($resultArray) : false;
    }

      
}

    
?>
