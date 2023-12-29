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

    public static function verifyUser($username, $password){
        global $database;
        $username = $database ->escapeString($username);
        $password = $database ->escapeString($password);

        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username = '{$username}'";
        $sql .= "AND password = '{$password}' LIMIT 1";

        $resultArray = self::findQuery($sql);
        return !empty($resultArray) ? array_shift($resultArray) : false;
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


    public function create(){
        global $database;
        $sql = "INSERT INTO users (username, password, Name, Last_Name)";
        $sql .= "VALUES ('";
        $sql .= $database->escapeString($this->username) ."', '";
        $sql .= $database->escapeString($this->password) ."', '";
        $sql .= $database->escapeString($this->firstName) ."', '";
        $sql .= $database->escapeString($this->lastName) ."')";

        if($database->query($sql)){
            $this->id = $database->insertId();
            return true;

        } else {
            return false;
        }
      }

      public function update(){
        global $database;
        $sql = "UPDATE users SET ";
        $sql .= "username= '" . $database->escapeString($this->username) . "', ";
        $sql .= "password= '" . $database->escapeString($this->password) . "', ";
        $sql .= "Name= '" . $database->escapeString($this->firstName) . "', "; //USING THE FUCNTION update CAUSES TO LOSE THIS PARAM FOR SOME REASON
        $sql .= "Last_Name= '" . $database->escapeString($this->lastName) . "' ";
        $sql .= " WHERE id= " . $database->escapeString($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
      }

      public function delete(){
        global $database;
        $sql = "DELETE FROM users ";
        $sql .= "WHERE id=" . $database->escapeString($this->id);
        $sql .= " LIMIT 1" ;

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
      }
      
}

    
?>

