<?php

class Db_Object{
    
    public static function findAll(){
        return static::findByQuery("SELECT * FROM " . static::$dbTable . " ");
    }

    public static function findById($userId){
        $resultArray = static::findByQuery("SELECT * FROM " . static::$dbTable . " WHERE id = $userId LIMIT 1");
        return !empty($resultArray) ? array_shift($resultArray) : false;
}

    public static function findByQuery($sql){
        global $database;
        $resultSet = $database->query($sql);
        $object = array();

        while($row = mysqli_fetch_array($resultSet)){
            $object[] = static::instantiation($row);
        }

        return $object;
    }

    public static function instantiation($record){
        $callingClass = get_called_class();
        $userObject = new $callingClass;
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
        foreach (static::$dbTableFields as $dbField){
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

        $sql = "INSERT INTO " . static::$dbTable . "(" . implode(",", array_keys($properties)) . ")";
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

        $sql = "UPDATE ".static::$dbTable. " SET ";
        $sql .= implode(", ", $propertiesPairs);
        $sql .= " WHERE id= " . $database->escapeString($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
      }

      public function delete(){
        global $database;
        $sql = "DELETE FROM ".static::$dbTable. " ";
        $sql .= "WHERE id=" . $database->escapeString($this->id);
        $sql .= " LIMIT 1" ;

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
      }

}