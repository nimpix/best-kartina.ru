<?php

if (!defined('DATALIFEENGINE')) {
    die("Hacking attempt!");
}

include('engine/api/api.class.php');
require_once('engine/modules/nimpixfilter/autoload.php');
require_once('engine/data/dbconfig.php');

$tpl = new dle_template();
$database = new \controllers\Connection();
$controller = new \controllers\FilterController($database,$tpl);



$controller->filter->generateHtml();

$content = $controller->filter->Filter($_REQUEST, $database, $tpl);

echo $content;

