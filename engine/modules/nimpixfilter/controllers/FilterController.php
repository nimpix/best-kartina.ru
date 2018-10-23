<?
namespace controllers;

use models\Filter;

Class FilterController
{
    private $dbh;
    private $prefix;
    public $filter;

    public function __construct(Connection $connection){
        $this->dbh = $connection;
        $this->prefix = $this->dbh->prefix;
        $this->filter = new Filter();
    }

    public function render(){
        require_once (ENGINE_DIR . '/modules/nimpixfilter/views/filter.tpl');
    }

}
