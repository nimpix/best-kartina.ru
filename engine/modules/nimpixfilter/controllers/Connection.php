<?

namespace controllers;

Class Connection
{
    public $db;
    public $prefix;

    public function __construct(){
        $this->db = new \PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);
        $this->prefix = PREFIX;
    }
}
