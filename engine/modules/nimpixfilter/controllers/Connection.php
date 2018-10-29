<?

namespace controllers;

Class Connection
{
    public $db;
    public $prefix;

    public function __construct(){
        $this->db = new \PDO('mysql:host=localhost;dbname='.DBNAME.';charset=cp1251', DBUSER, DBPASS);

        $stmt = $this->db->prepare("SET NAMES 'cp1251'");
        $stmt = $this->db->prepare("SET CHARACTER SET 'cp1251'");
        $stmt->execute();
        $this->prefix = PREFIX;
    }
}
