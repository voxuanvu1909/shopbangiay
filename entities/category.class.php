<?php
    require_once("./config/db.class.php");

    class Category{
        public $cateID;
        public $categoryName;
        public $description;

        
        public function __construct($cate_name, $des){
            $this->categoryName = $cate_name;
            $this->description = $des;
        }

        public static function list_category(){
            $db = new Db();
            $sql = "SELECT * FROM category";
            $categories = $db->select_to_array($sql);
            return $categories;
        }
    }
?>