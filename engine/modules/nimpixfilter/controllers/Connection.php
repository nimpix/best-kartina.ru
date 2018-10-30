<?

namespace controllers;

Class Connection
{
    public $db;
    public $prefix;

    public function __construct(){
        $this->db = new \PDO('mysql:host=localhost;dbname='.DBNAME.';charset=cp1251', DBUSER, DBPASS);

        $this->prefix = PREFIX;
    }
}
