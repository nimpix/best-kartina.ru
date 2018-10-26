<?php

if (!defined('DATALIFEENGINE')) {
    die("Hacking attempt!");
}

include('engine/api/api.class.php');
require_once('engine/modules/nimpixfilter/autoload.php');
require_once('engine/data/dbconfig.php');


$database = new \controllers\Connection();
$controller = new \controllers\FilterController($database);

$tpl = new dle_template();

$controller->filter->Filter($_REQUEST, $database, $tpl);




