<?php

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}

spl_autoload_register('autoload');

require_once('engine/data/dbconfig.php');

$init = new \controllers\FilterController(new \controllers\Connection());

//$stmt = $dbh->prepare("SELECT * FROM ${PREFIX} WHERE xfields LIKE ?");
//
////$stmt->bindParam(':filter', $filter);
//$filter = $_GET['filter'];
//$stmt->execute(array("%$filter%"));
//
//if(!empty($stmt)){echo '111';}
//query("SELECT p.id, p.autor, p.date, p.short_story, p.full_story, p.xfields, p.title, p.category, p.alt_name, p.comm_num,
//p.allow_comm, p.fixed, p.tags, e.news_read, e.allow_rate, e.rating, e.vote_num, e.votes, e.view_edit, e.editdate, e.editor,
//e.reason FROM " . PREFIX . "_post p)