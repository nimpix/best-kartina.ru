<?php


if( !defined( 'DATALIFEENGINE' ) OR !defined( 'LOGGED_IN' ) ) {
	die( "Hacking attempt!" );
}


if ($_REQUEST['action'] == "postsort") {

	if( !$user_group[$member_id['user_group']]['admin_categories'] ) die ("error");

	if ( !count($_POST['list']) ) die ("error");

	$i= count($_POST['list']); // Считаем сколько у нас элементов и перебираем с конца

	$i= 0;

	foreach ( $_POST['list'] as $id => $parentid ) {
		$i++;

		$id = intval($id);
//		$parentid = intval($parentid);

		if ( $id ) {

			$db->query( "UPDATE " . PREFIX . "_post SET sorting='{$i}' WHERE id = '{$id}'" );

		}
	}

//	@unlink( ENGINE_DIR . '/cache/system/category.php' );
//	$db->query( "INSERT INTO " . USERPREFIX . "_admin_logs (name, date, ip, action, extras) values ('".$db->safesql($member_id['name'])."', '{$_TIME}', '{$_IP}', '11', '')" );

	$buffer = 'ok'; // Отвечает скрипту, что всё выполнено


echo $buffer; // В DLE эта переменная выводилас в конце файла, после всех функция, а мы должны вывести её сразу т.к. других функций у нас нет


}else{


if ($_REQUEST['approve'] == 1) {

$opublikovannie = "AND `approve` = 1";

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






// $result = $db->query("SELECT `l`.*, `c`.`title` FROM `" . PREFIX . "_call` AS `l` INNER JOIN `" . PREFIX . "_call_cat` AS `c` ON `c`.`id` = `l`.`cat` WHERE `status` = 0");
$result = $db->query("SELECT `id`, `sorting`, `title`, `category`, `alt_name`, `short_story`, `xfields`, `news_read`, `approve` FROM `" . PREFIX . "_post`, `" . PREFIX . "_post_extras` WHERE `" . PREFIX . "_post`.`id` = `" . PREFIX . "_post_extras`.`news_id` $opublikovannie ORDER BY `" . PREFIX . "_post`.`sorting` ASC, `" . PREFIX . "_post`.`date` DESC"); // Сортируем по двум полям - по sorting и по date (как в самом DLE)

html_header('Сортировка новостей');
echo <<<HTML
<a href="$PHP_SELF?mod=sort&approve=1" class="btn btn-success" style="color: white;">Только опубликованные</a> <a href="$PHP_SELF?mod=sort" class="btn btn-info" style="color: white;">Все товары</a><br>
<table width="100%">
    <tr>
        <td style="padding:2px;"><ol class="sortable">
HTML;

while ($row = $db->get_row($result)) {

$news_url = $config['http_home_url'] . get_url( intval( $row['category'] ) ) . '/' .$row['id'].'-'.$row['alt_name'].'.html';
$post_image = post_image($row['short_story']);
$post_image = str_replace("http://монстер-битс.рф/", "http://xn----btbkoqggshfff.xn--p1ai/", $post_image);

$xfieldsdata_price = xfieldsdataload( $row[xfields] );
$new_price = $xfieldsdata_price[price];
$artikul = $xfieldsdata_price[art];

echo <<<HTML
<li id="list_{$row['id']}"><div><b>ID:{$row['id']} - {$artikul}</b> <a class="list" href="$news_url" target="_blank">{$row['title']}&nbsp;({$row['news_read']}&nbsp;/&nbsp;{$new_price} р.)</a> <br><img src="/img/img.php?h=250&w=250&src=$post_image" /></div>
HTML;

unset($news_url, $post_image, $new_price);
}

echo <<<HTML
        </ol></td>
    </tr>
    <tr>
        <td colspan="7" style="padding:5px;"><button id="postsort" class="btn btn-primary">Сохранить порядок сортировки</button></td>
    </tr>
</table>




	<style>
	.sortable { list-style-type: none; margin: 0; padding: 0; }
	.sortable li { margin: 3px 3px 3px 0; padding: 5px; float: left; width: 280px; text-align: center; }
	.sortable li div { height: 280px; }
	.sortable li div img { max-width: 250px; max-height: 250px; }
	</style>

	<script>
	$(function() {
		$( ".sortable" ).sortable();
		$( ".sortable" ).disableSelection();
	});
	</script>


<script type="text/javascript" src="engine/skins/uisortable.js"></script>
<script type="text/javascript" src="engine/skins/categorysortable.js"></script>


<script>
	$(document).ready(function(){

		$('ol.sortable').nestedSortable({
			forcePlaceholderSize: true,
			handle: 'div',
			helper:	'clone',
			items: 'li',
			maxLevels: 0,
			opacity: .6,
			placeholder: 'placeholder',
			revert: 250,
			tabSize: 25,
			tolerance: 'pointer',
			toleranceElement: '> div'
		});

		$('#postsort').click(function(){
			var cats = $('ol.sortable').nestedSortable('serialize');
			var url = "action=postsort&"+cats;

			ShowLoading('');
			$.post('', url, function(data){
	
				HideLoading('');
	
				if (data == 'ok') {

					DLEalert('Сортировка успешно сохранена.', 'Информация');

				} else {

					DLEalert('Сортировка завершилось ошибкой.', 'Информация');

				}
	
			});

		});


	});

</script>

HTML;
html_footer();




echofooter();

}
?>