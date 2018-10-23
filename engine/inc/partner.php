<?
if(!defined('DATALIFEENGINE'))
{
  die("Hacking attempt!");
}

// Рассчет партнерских цен для дропшипперов


function xfieldsdataload2($id) { // Моя функция - удалена лишняя замена
	if( $id == "" ) return;
	
	$xfieldsdata = explode( "||", $id );
	foreach ( $xfieldsdata as $xfielddata ) {
		list ( $xfielddataname, $xfielddatavalue ) = explode( "|", $xfielddata );
		$data[$xfielddataname] = $xfielddatavalue;
	}
	return $data;
}




 function post_image($short_story){

			$images = array();
			preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $short_story, $media);
			$data=preg_replace('/(img|src)("|\'|="|=\')(.*)/i',"$3",$media[0]);
	
			foreach($data as $url) {
				$info = pathinfo($url);
				if (isset($info['extension'])) {
					if ($info['filename'] == "spoiler-plus" OR $info['filename'] == "spoiler-plus" ) continue;
					$info['extension'] = strtolower($info['extension']);
					if (($info['extension'] == 'jpg') || ($info['extension'] == 'jpeg') || ($info['extension'] == 'gif') || ($info['extension'] == 'png')) array_push($images, $url);
				}
			}

return $images[0];

}










echoheader('', '');













// $result = $db->query("SELECT id,title,xfields,category FROM ".USERPREFIX."_post ORDER BY `sorting` ASC");
   $result = $db->query("SELECT id,title,xfields,category,short_story FROM ".USERPREFIX."_post ORDER BY `id` ASC");

echo <<<HTML
<table width="100%" id="newslist">
	<tr class="thead">
    	<th width="120" style="text-align: left;">&nbsp;Артикул&nbsp;</th>
    	<th width="90" style="text-align: left;">&nbsp;Размер M&nbsp;</th>
    	<th width="90" style="text-align: left;">&nbsp;Размер L&nbsp;</th>
    	<th width="90" style="text-align: left;">&nbsp;Размер XL&nbsp;</th>
    	<th width="150">Превью</th>
	</tr>
	<tr class="tfoot"><td colspan="6"><div class="hr_line"></div></td></th>
HTML;
while ($row = $db->get_row($result)) {

	$xfieldsdata = xfieldsdataload2( $row['xfields'] );

//  $row[title] = str_replace("Monster Beats ", "", $row[title]);




 if(empty($xfieldsdata['art_interior'])){$xfieldsdata['art_interior'] = "Пусто";} // В начале документа есть проверка - если случайно передали в запросе эту фразу, то НЕ перезаписываем её в БД т.к. это просто информационная фраза


$post_image = post_image($row['short_story']);
$post_image = str_replace($config['http_home_url'], "/", $post_image); // На главной странице сайта адрес выводится в нужной кодировке, а здесь в исходной - как в БД



$cena_m = ceil($xfieldsdata['cena_m'] * 0.5 / 100) * 100; // 0.5 - это стоимость картины, а не % отчисления
$cena_l = ceil($xfieldsdata['cena_l'] * 0.5 / 100) * 100 ;
$cena_xl = ceil($xfieldsdata['cena_xl'] * 0.5 / 100) * 100 ;




$cat = explode(",", $row['category']);
$categories = unserialize(file_get_contents(ENGINE_DIR . '/cache/system/category.php'));


echo <<<HTML
	<tr>
        <td>{$row['id']} / {$xfieldsdata['articul2']}</td>
        <td>{$xfieldsdata['razmer_m']} - $cena_m р.</td>
        <td>{$xfieldsdata['razmer_l']} - $cena_l р.</td>
        <td>{$xfieldsdata['razmer_xl']} - $cena_xl р.</td>
        <td><a href="$post_image" target="_blank"><img src="/img/img.php?h=130&amp;w=150&amp;src=$post_image"></a></td>
    </tr>
	<tr><td background="engine/skins/images/mline.gif" height=1 colspan=6></td></tr>
HTML;

unset($post_image, $razmer_m, $razmer_l, $razmer_xl, $cena_m, $cena_l, $cena_xl);
}
echo <<<HTML
</table>
HTML;


















echofooter();




 
?>