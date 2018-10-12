<?php //conection db
//singleton
class Database  
{
    // Hold the class instance.
    private static $_instance = null;
    private $_db;
    
    private function __construct()
    {
        $this->_db = new \PDO('mysql:host=localhost;dbname=blog_jf;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    protected function __clone(){}

    public static function getInstance()
    {
        if (self::$_instance == null)
        {
      		self::$_instance = new Database();
        }
 
        return self::$_instance;
    }

    public function dbConnect()
    {
        return $this->_db;
    }
}