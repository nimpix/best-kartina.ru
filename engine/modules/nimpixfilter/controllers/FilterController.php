<?

namespace controllers;

use models\Filter;

Class FilterController
{
    private $dbh;
    private $prefix;
    public $filter;

    public function __construct(Connection $connection,$tpl)
    {
        dle_session();
        $this->dbh = $connection;
        $this->prefix = $this->dbh->prefix;

        $this->filter = new Filter($tpl,$this->dbh);
    }

    public function render()
    {

    }

}
