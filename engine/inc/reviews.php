<?php


if( !defined( 'DATALIFEENGINE' ) OR !defined( 'LOGGED_IN' ) ) {
	die( "Hacking attempt!" );
}

if( $member_id['user_group'] != 1 ) {
	msg( "error", $lang['index_denied'], $lang['index_denied'] );
    die();
}



if($_POST['id'] && $_POST['type'] && $_POST['value']){


 $_POST['value'] = iconv("UTF-8", "CP1251", $_POST['value']);

		$id = intval($_POST['id']);
		if ( $id ) {
			$db->query( "UPDATE " . PREFIX . "_otzivi SET {$_POST['type']}='{$_POST['value']}' WHERE id = '{$id}'" );
		}
echo 'ok';


}else{


function to_normal_alt1 ($alt) {
    $alt = intval($alt);

  if(strlen($alt) == '1') $vt = $alt;
           else 
         $vt = substr($alt, -1);

  if($vt == '0') $p = ' лет, ';
  elseif($vt == '1') $p = ' год, ';
  elseif($vt <= '4') $p = ' года, ';
  else $p = ' лет, '; 
  return $p;
}


$do = $_GET['do'];

echoheader( "", "" );

function html_header($title) {
echo <<<HTML
<div style="padding-top:5px;padding-bottom:2px;">
<table width="100%">
    <tr>
        <td width="4"><img src="engine/skins/images/tl_lo.gif" width="4" height="4" border="0"></td>
        <td background="engine/skins/images/tl_oo.gif"><img src="engine/skins/images/tl_oo.gif" width="1" height="4" border="0"></td>
        <td width="6"><img src="engine/skins/images/tl_ro.gif" width="6" height="4" border="0"></td>
    </tr>
    <tr>
        <td background="engine/skins/images/tl_lb.gif"><img src="engine/skins/images/tl_lb.gif" width="4" height="1" border="0"></td>
        <td style="padding:5px;" bgcolor="#FFFFFF">
<table width="100%">
    <tr>
        <td bgcolor="#EFEFEF" height="29" style="padding-left:10px;"><div class="navigation">{$title}</div></td>
    </tr>
</table>
<div class="unterline"></div>
HTML;
}
function html_footer() {
echo <<<HTML
        </td>
        <td background="engine/skins/images/tl_rb.gif"><img src="engine/skins/images/tl_rb.gif" width="6" height="1" border="0"></td>
    </tr>
    <tr>
        <td><img src="engine/skins/images/tl_lu.gif" width="4" height="6" border="0"></td>
        <td background="engine/skins/images/tl_ub.gif"><img src="engine/skins/images/tl_ub.gif" width="1" height="6" border="0"></td>
        <td><img src="engine/skins/images/tl_ru.gif" width="6" height="6" border="0"></td>
    </tr>
</table>
</div>
HTML;
}

html_header('Модуль: Отзывы покупателей');

echo <<<HTML
<table width="100%"><tr><td width="50%">
<table width="100%">
    <tr>
        <td width="70" height="70" valign="middle" align="center" style="padding-top:5px;padding-bottom:5px;"><img src="engine/skins/images/spset.png" border="0"></td>
        <td valign="middle"><div class="quick"><a href="$PHP_SELF?mod=reviews&amp;do=new"><h3>Новые отзывы на модерации</h3>Список новых отзывов, не отображаемых на сайте</a></div></td>
    </tr>
</table>
</td><td width="50%">
<table width="100%">
    <tr>
        <td width="70" height="70" valign="middle" align="center" style="padding-top:5px;padding-bottom:5px;"><img src="engine/skins/images/spset.png" border="0"></td>
        <td valign="middle"><div class="quick"><a href="$PHP_SELF?mod=reviews&amp;do=cat"><h3>Опубликованные отзывы</h3>Список отзывов, выводимых на сайте</a></div></td>
    </tr>
</table>
</td></tr><tr><td width="50%">
<table width="100%">
    <tr>
        <td width="70" height="70" valign="middle" align="center" style="padding-top:5px;padding-bottom:5px;"><img src="engine/skins/images/spset.png" border="0"></td>
        <td valign="middle"><div class="quick"><a href="$PHP_SELF?mod=reviews&amp;do=add"><h3>Добавить отзывы</h3>Здесь можно сразу добавить новый отзыв.</a></div></td>
    </tr>
</table>
</td></tr></table>
HTML;
html_footer();


if ($do == 'delete') {
    
    $id = intval($_GET['id']);
    
    if ($id > 0) {
        
//        $db->query("DELETE FROM `" . PREFIX . "_otzivi` WHERE `id` = {$id}");
//        echo '<div style="text-align: center;">Запись с ID '.$id.' удалена. <a href="$PHP_SELF?mod=reviews">Вернуться назад.</a></div>';
echo "Удаление отключено";
        
    }
    else {
        html_header('Модуль: Отзывы покупателей');
        echo '<div style="text-align: center;">Не указан ID! <a href="'.$PHP_SELF.'?mod=reviews">Вернуться назад.</a></div>';
        html_footer();
    }
    
}

elseif ($do == 'ok') {

    $id = intval($_GET['id']);

    if ($id > 0) {

        $db->query("UPDATE `" . PREFIX . "_otzivi` SET `moderation` = 1 WHERE `id` = {$id}");
        echo '<div style="text-align: center;">Запись с ID '.$id.' обработана. <a href="'.$PHP_SELF.'?mod=reviews">Вернуться назад.</a></div>';
        html_footer();
    }
    else {
        html_header('Модуль: Отзывы покупателей');
        echo '<div style="text-align: center;">Не указан ID! <a href="'.$PHP_SELF.'?mod=reviews">Вернуться назад.</a></div>';
        html_footer();
    }

}

elseif ($do == 're') {

    $id = intval($_GET['id']);
    
    if ($id > 0) {
        
        $db->query("UPDATE `" . PREFIX . "_otzivi` SET `moderation` = 0 WHERE `id` = {$id}");
        html_header('Модуль: Отзывы покупателей');
        echo '<div style="text-align: center;">Запись с ID '.$id.' отправлена на обработку. <a href="'.$PHP_SELF.'?mod=reviews">Вернуться назад.</a></div>';
        html_footer();
    }
    else {
        html_header('Модуль: Отзывы покупателей');
        echo '<div style="text-align: center;">Не указан ID! <a href="'.$PHP_SELF.'?mod=reviews&do=list">Вернуться назад.</a></div>';
        html_footer();
    }

}

elseif ($do == 'add') {

// Добавить отзыв

}










elseif ($do == 'new') { // Новые отзывы

$result = $db->query("SELECT * FROM " . PREFIX . "_otzivi WHERE moderation = 0 ORDER BY id DESC");
html_header('Модуль: Отзывы покупателей');
echo <<<HTML
<table width="100%" id="newslist">
	<tr class="thead">
        <th>&nbsp;&nbsp;Комментарий</th>
    	<th width="120" style="text-align: center;">&nbsp;Фото&nbsp;</th>
    	<th width="120" style="text-align: center;">&nbsp;Имя&nbsp;</th>
    	<th width="200" style="text-align: center;">&nbsp;Возраст / город&nbsp;</th>
        <th width="80" style="text-align: center;">Действия</th>
	</tr>
	<tr class="tfoot"><td colspan="6"><div class="hr_line"></div></td></th>
HTML;
while ($row = $db->get_row($result)) {

    $date = date ('d.m.Y', $row['date']); 


$age = "";
if (!empty ($row[age])){
$age = $row[age].to_normal_alt1($row[age]);
}

echo <<<HTML
	<tr>
        <td class="list" style="padding:4px;">{$date} - {$row['comment']}</td>
        <td align=center><img src="/uploads/fotos/$row[foto]" width="70px"></td>
        <td align=center>{$row['name']}</td>
        <td align=center>{$age}{$row[city]}</td>
        <td style="text-align: center">
            <a href="$PHP_SELF?mod=reviews&do=ok&id={$row['id']}"><img src="engine/skins/images/led_on.png" title="Опубликовать" alt="Опубликовать" width="16" height="16" border="0"/></a>
            <a href="$PHP_SELF?mod=reviews&do=delete&id={$row['id']}"><img src="engine/skins/images/delete.png" title="Удалить" alt="Удалить" width="16" height="16" border="0"/></a>
        </td>
    </tr>
	<tr><td background="engine/skins/images/mline.gif" height=1 colspan=6></td></tr>
HTML;

}

echo <<<HTML
</table>
<p><a href="$PHP_SELF?mod=reviews">Список НЕ обработанных звонков</a></p>
HTML;
html_footer();
}



else { // Опубликованные и проверенные

$result = $db->query("SELECT * FROM " . PREFIX . "_otzivi WHERE moderation = 1 ORDER BY id DESC");
html_header('Модуль: Отзывы покупателей');
echo <<<HTML
<table width="100%" id="newslist">
	<tr class="thead">
        <th>&nbsp;&nbsp;Комментарий</th>
    	<th width="120" style="text-align: center;">&nbsp;Фото&nbsp;</th>
    	<th width="120" style="text-align: center;">&nbsp;Имя&nbsp;</th>
    	<th width="200" style="text-align: center;">&nbsp;Возраст / город&nbsp;</th>
        <th width="80" style="text-align: center;">Действия</th>
	</tr>
	<tr class="tfoot"><td colspan="6"><div class="hr_line"></div></td></th>
HTML;
while ($row = $db->get_row($result)) {

    $date = date ('d.m.Y', $row['date']); 

$age = "";
if (!empty ($row[age])){
$age = $row[age].to_normal_alt1($row[age]);
}

echo <<<HTML
	<tr>
        <td><span id="{$row['id']}" type="comment" class="editable-area">{$row['comment']}</span></td>
        <td align=center><img src="/uploads/fotos/$row[foto]" width="70px"></td>
        <td align=center><span id="{$row['id']}" type="name" class="editable">{$row['name']}</span></td>
        <td align=center>{$age}{$row[city]}</td>
        <td align=center>
            <a href="$PHP_SELF?mod=reviews&do=re&id={$row['id']}"><img src="engine/skins/images/notepad.png" title="На модерацию" alt="На модерацию" width="16" height="16" border="0"/></a>
            <a href="$PHP_SELF?mod=reviews&do=delete&id={$row['id']}"><img src="engine/skins/images/delete.png" title="Удалить" alt="Удалить" width="16" height="16" border="0"/></a>
        </td>
    </tr>
	<tr><td background="engine/skins/images/mline.gif" height=1 colspan=6></td></tr>
HTML;

}

echo <<<HTML
</table>
<p><a href="$PHP_SELF?mod=reviews&do=new">Список обработанных звонков</a></p>

<script type="text/javascript" src="engine/classes/js/ajax_edit.js"></script>
HTML;
html_footer();
}









echofooter();



}

?>