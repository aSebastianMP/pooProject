<?php

class Photo extends Db_Object {
        protected static $dbTable = "photos";
        protected static $dbTableFields = array('photoId','title','photoDescription','fileName','type','size');
        public $id;
        public $title;
        public $photoDescription;
        public $fileName;
        public $type;
        public $size;
        public $tmpPath;
        public $uploadDirectory = "images";
        public $errors = array();
        public $uploadErrorsArray = array(
            UPLOAD_ERR_OK =>         "There is no error",
            UPLOAD_ERR_INI_SIZE =>   "The uploaded file exceeds the upload_max_filesize directive cap.",
            UPLOAD_ERR_FORM_SIZE =>  "The uploaded file exceeds the MAX_FILE_SIZE directive.",
            UPLOAD_ERR_PARTIAL =>    "The upload file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE =>    "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION =>  "A PHP extension stopped the file upload."
        );

        public function setFile($file){

            if(empty($file) || !$file || !is_array($file)){
                $this->errors[] = "There was no file uploaded here";
                return false;
            }elseif($file['error'] !=0){
                $this->errors[] = $this->uploadErrorsArray[$file['error']];
                return false;
            } else {
                $this->fileName = basename($file['name']);
                $this->tmpPath = $file['tmp_name'];
                $this->type = $file['type'];
                $this->size = $file['size'];
            }
        }

        public function picturePath(){
            return $this->uploadDirectory.DS.$this->fileName;
        }

        public function save(){
            if($this->id){
                $this->update(); 
            } else {
                if(!empty($this->errors)){
                    return false;
                }
                if (empty($this->fileName) || empty($this->tmpPath)){
                    $this->errors[] = "The file was not available";
                    return false;
                }
                $targetPath = SITE_ROOT . DS . 'admin' . DS . $this->uploadDirectory . DS . $this->fileName;

                if(file_exists($targetPath)){
                    $this->errors[] = "The file {$this->fileName} already exists";
                }
                if(move_uploaded_file($this->tmpPath, $targetPath)){
                    if($this->create()){
                        unset($this->tmpPath);
                        return true;
                    }
                } else {
                    $this->errors[] = "The folder probably doesn't have permissions";
                    return false;
                }
            }
        }


}