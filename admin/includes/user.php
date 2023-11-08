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
            $resultArray = self::findQuery("SELECT * FROM users WHERE id = $userId LIMIT 1");
            return !empty($resultArray) ? array_shift($resultArray) : false;

            // if(!empty($resultArray)){
            //     $firstItem = array_shift($resultArray);
            //     return $firstItem;
            // } else{
            //     return false;
            // }

            //return $foundUser;
    }

    public static function findQuery($sql){
        global $database;
        $resultSet = $database->query($sql);
        $object = array();

        while($row = mysqli_fetch_array($resultSet)){
            $object[] = self::instantiation($row);
        }

        return $object;
    }

    public static function instantiation($record){
        $userObject = new self;
        // $userObject->id        =  $foundUser["id"];
        // $userObject->username  =  $foundUser["username"];
        // $userObject->password  =  $foundUser["password"];
        // $userObject->firstName =  $foundUser["Name"];
        // $userObject->lastName  =  $foundUser["Last_Name"];

        foreach($record as $attribute => $value){
            if($userObject->hasAttribute($attribute)){
                $userObject->$attribute = $value;
            }
        }

        return $userObject;

    }

    private function hasAttribute($attribute){
        $objectProperties = get_object_vars($this);
        return array_key_exists($attribute, $objectProperties);
    }
}
?>

