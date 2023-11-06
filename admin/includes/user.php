<?php


    class User{
        public $id;
        public $username;
        public $password;
        public $firstName;
        public $lastName;

        public static function findAllUsers(){
            return self::findQuery("SELECT * FROM users");
        }

        public static function findUserById($userId){
            $resultSet = self::findQuery("SELECT * FROM users WHERE id = $userId LIMIT 1");
            $foundUser = mysqli_fetch_array($resultSet);
            return $foundUser;
    }

    public static function findQuery($sql){
        global $database;
        $resultSet = $database->query($sql);
        return $resultSet;
    }

    public static function instantiation($foundUser){
        $userObject = new self;
        $userObject->id        =  $foundUser["id"]."<br>";
        $userObject->username  =  $foundUser["username"]."<br>";
        $userObject->password  =  $foundUser["password"]."<br>";
        $userObject->firstName =  $foundUser["Name"]."<br>";
        $userObject->lastName  =  $foundUser["Last_Name"]."<br>";

        return $userObject;

    }
}
?>