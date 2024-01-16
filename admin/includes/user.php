<?php


    class User{

        protected static $dbTable = "users";
        protected static $dbTableFields = array('username','password','firstName','lastName');
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

    protected function properties(){
        $properties = array();
        foreach (self::$dbTableFields as $dbField){
            if(property_exists($this, $dbField)){
                $properties[$dbField] = $this->$dbField;
            }
        }
        return $properties;
    }

    protected function cleanProperties(){
        global $database;
        $cleanProperties = array();

        foreach ($this->properties() as $key => $value){
            $cleanProperties[$key] = $database->escapeString($value);
        }
        return $cleanProperties; 
    }


    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }


    public function create(){
        global $database; 
        $properties = $this->cleanProperties();

        $sql = "INSERT INTO " . self::$dbTable . "(" . implode(",", array_keys($properties)) . ")";
        $sql .= "VALUES ('". implode("','", array_values($properties)) ."')";

        if($database->query($sql)){
            $this->id = $database->insertId();
            return true;

        } else {
            return false;
        }
      }

      public function update(){
        global $database;
        $properties = $this->cleanProperties();
        $propertiesPairs = array();

        foreach($properties as $key=>$value) {
            $propertiesPairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE ".self::$dbTable. " SET ";
        $sql .= implode(", ", $propertiesPairs);
        $sql .= " WHERE id= " . $database->escapeString($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
      }

      public function delete(){
        global $database;
        $sql = "DELETE FROM ".self::$dbTable. " ";
        $sql .= "WHERE id=" . $database->escapeString($this->id);
        $sql .= " LIMIT 1" ;

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
      }
      
}

    
?>
