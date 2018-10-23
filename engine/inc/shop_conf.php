<?php

if(!defined('DATALIFEENGINE'))
{
  die("Попытка взлома!");
}

include ENGINE_DIR.'/data/shop_conf.php';


function opentable() {
echo <<<HTML
<table width="100%">
    <tr>
        <td width="4"><img src="engine/skins/images/tl_lo.gif" width="4" height="4" border="0"></td>
        <td background="engine/skins/images/tl_oo.gif"><img src="engine/skins/images/tl_oo.gif" width="1" height="4" border="0"></td>
        <td width="6"><img src="engine/skins/images/tl_ro.gif" width="6" height="4" border="0"></td>
    </tr>
    <tr>
        <td background="engine/skins/images/tl_lb.gif"><img src="engine/skins/images/tl_lb.gif" width="4" height="1" border="0"></td>
        <td style="padding:5px;" bgcolor="#FFFFFF">
HTML;
}
function closetable() {
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
HTML;
}
function tableheader($value) {
echo <<<HTML
<table width="100%">
    <tr>
        <td bgcolor="#EFEFEF" height="29" style="padding-left:10px;"><div class="navigation">{$value}</div></td>
    </tr>
</table>
HTML;
 unterline();
}
function unterline() {
echo <<<HTML
<div class="unterline"></div>
HTML;
}

if ($_REQUEST['action'] == "") {



function showRow($title="", $description="", $field="", $line, $gomod=false) {
        global $lang;

echo <<<HTML
<tr>
<td style="padding:4px" class="option"><b>{$title}</b><br />
<span class=small>{$description}</span> </td>
<td width=394 align=middle>{$field}</td></tr>
HTML;
if($line != "no") echo "<tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=2></td></tr>";
	$bg = ""; $i++;
}



function makeDropDown($options, $name, $selected, $off)
    {
        $output = "<select $off size=1 name=\"$name\">\r\n";
        foreach($options as $value=>$description)
        {
          $output .= "<option value=\"{$value}\"";
          if($selected == $value){ $output .= " selected "; }
          $output .= ">{$description}</option>\n";
        }
        $output .= "</select>";
        return $output;
    }

    echoheader("", "");
    opentable();
    tableheader("Панель модуля интернет магазина");

echo <<<HTML

<script type="text/javascript" src="engine/skins/tabs.js"></script>
<form method="post">
<div id="dle_tabView1">

<div class="dle_aTab" style="display:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
HTML;
    showRow("ID Метрики", "Номер счетчика яндекс метрики","<input type=text style='text-align: center;' size=30 class=edit name='save_config[yaCounter_id]' value='{$shop_conf['yaCounter_id']}'>","", "basic");
    showRow("VK Пользователей", "ID пользователй VK которым отсылать уведомлений","<input type=text style='text-align: center;' size=30 class=edit name='save_config[vk_uid]' value='{$shop_conf['vk_uid']}'>","", "basic");
    showRow("VK access token", "Токен авторизации в контакте","<input type=text style='text-align: center;' size=30 class=edit name='save_config[vk_access_token]' value='{$shop_conf['vk_access_token']}'>","", "basic");
    showRow("Почта для отправки уведомлений", "Почта для отправки уведомлений","<input type=text style='text-align: center;' size=30 class=edit name='save_config[email]' value='{$shop_conf['email']}'>","", "basic");
    showRow("Google Docs id", "ID документа Google Docs","<input type=text style='text-align: center;' size=30 class=edit name='save_config[google_docs_id]' value='{$shop_conf['google_docs_id']}'>","", "basic");
    showRow("Google Docs macros", "Макрос Google Docs","<input type=text style='text-align: center;' size=30 class=edit name='save_config[google_docs_macros]' value='{$shop_conf['google_docs_macros']}'>","", "basic");
    showRow("Лист Google Docs", "На какой лист Google Docs отправлять данные","<input type=text style='text-align: center;' size=30 class=edit name='save_config[google_docs_list]' value='{$shop_conf['google_docs_list']}'>","", "basic");
    showRow("Телефон в яндекс YML", "Номер телефона в яндекс YML","<input type=text style='text-align: center;' size=30 class=edit name='save_config[phone]' value='{$shop_conf['phone']}'>","", "basic");
    showRow("Время актуальности яндекс YML", "Через сколько часов обновлять яндекс YML","<input type=text style='text-align: center;' size=30 class=edit name='save_config[yml_lifetime]' value='{$shop_conf['yml_lifetime']}'>","", "basic");

echo <<<HTML
  </tr>
</table>
</div>







</div>

<div style="padding-left:5px;padding-top:5px;padding-bottom:5px;"><input type=hidden name=mod value="shop_conf"><input type=hidden name=action value="save">
 
 <input type=hidden name=savecfg value="savecfg"><input type=submit class=edit value="Сохранить настройки">
</div>
</form>
<script type="text/javascript">
initTabs('dle_tabView1',Array('Настройки','Шаблон ответа'),0, '100%');
</script>
</div>
HTML;

closetable();
echofooter();












//--------------------------------------------
// Сохранение настроек
//--------------------------------------------
} elseif ($_REQUEST['action'] == "save") {

	if( $member_id['user_group'] != 1 ) {
		msg( "error", $lang['opt_denied'], $lang['opt_denied'] );
	}

if ($_REQUEST['savecfg'] != "savecfg") include ENGINE_DIR.'/data/shop_conf.php';
if($_REQUEST['savecfg'] == "savecfg")
{
    $find[]     = "'\r'";
        $replace[]      = "";
    $find[]     = "'\n'";
        $replace[]      = "";
		$save_config = $_POST['save_config'];
        $handler = fopen(ENGINE_DIR.'/data/shop_conf.php', "w");
        fwrite($handler, "<?php \r\n//Модуль интернет магазина\n\n\$shop_conf = array (\r\n");
        foreach($save_config as $name => $value)
        {
                $value=trim(stripslashes ($value));
                $value=htmlspecialchars ($value, ENT_QUOTES);
                $value = preg_replace($find,$replace,$value);
                fwrite($handler, "'{$name}' => \"{$value}\",\r\n");
        }

        fwrite($handler, ");\r\n?>");
        fclose($handler);




msg("info", "Выполнено", "Настройки успешно сохранены.<br><br><input type='button' value=\"На главную\" class='edit' onclick=\"window.location='$PHP_SELF?mod=shop_conf'\">", "");
 }
 };






?>
