<?php

class Photo extends Db_Object {
        protected static $dbTable = "photos";
        protected static $dbTableFields = array('photoId','title','photoDescription','fileName','type','size');
        public $photoId;
        public $title;
        public $photoDescription;
        public $fileName;
        public $type;
        public $size;
        public $tmpPath;
        public $uploadDirectory = "images";
        public $customErrors = array();
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


}