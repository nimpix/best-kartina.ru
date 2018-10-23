<?
namespace controllers;

Class FilterController
{
    private $dbh;
    private $prefix;

    public function __construct(Connection $connection){
        $this->dbh = $connection;
        $this->prefix = $this->dbh->prefix;
    }

}
