<?php

define( 'DATALIFEENGINE', true );
define( 'ROOT_DIR', '..' );
define( 'ENGINE_DIR', dirname( __FILE__ ) );

@error_reporting ( E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set ( 'display_errors', true );
@ini_set ( 'html_errors', false );
@ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );

include ENGINE_DIR . '/data/config.php';
include ENGINE_DIR . '/data/shop_conf.php';
require_once ENGINE_DIR . '/modules/functions.php';
require_once ENGINE_DIR . '/classes/mysql.php';
include_once ENGINE_DIR . '/data/dbconfig.php';

			$cat_info = get_vars( "category" ); // Нужно для работы get_url

if( $config['http_home_url'] == "" ) {
	
	$config['http_home_url'] = "http://" . clean_url($_SERVER['HTTP_HOST']) . "/";

}else{
$config['http_home_url'] = "http://" . clean_url($config['http_home_url']) . "/";
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

$images[0] = str_replace("thumbs/", "", $images[0]); // Замена ссылок на полное изображение

return $images[0];

}

$datetime = date( "Y-m-d H:i" );

    $file = ROOT_DIR.'/uploads/wp.xml';







$rss_content = <<<XML
<?xml version="1.0" encoding="{$config['charset']}"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="$datetime">
    <shop>
        <name>{$config['home_title']}</name>
        <company>{$config['home_title']}</company>
        <url>{$config['http_home_url']}</url>
$phone
        <currencies>
            <currency id="RUB" rate="1" />
        </currencies>
        <categories>
XML;

	
		




				$result = $db->query( "SELECT * FROM `" . PREFIX . "_category`" );

// id, parentid, name, alt_name
$c_array=array();
while ($row = $db->get_row($result)) {

if(!empty($row['parentid'])){$parentId = ' parentId="'.$row['parentid'].'"';}

$rss_content .= <<<XML

            <category id="{$row['id']}"$parentId>{$row['name']}</category>
XML;
$c_array[$row['id']]=$row['name'];
}


$rss_content .= <<<XML

        </categories>
        <offers>
XML;






$result = $db->query( "SELECT `id`, `title`, `category`, `alt_name`, `short_story`, `xfields`, `approve` FROM `" . PREFIX . "_post` WHERE `approve` = 1" );


while ($row = $db->get_row($result)) {

$news_url = $config['http_home_url'] . get_url( intval( $row['category'] ) ) .'/'.$row['id'].'-'.$row['alt_name'].'.html'; // Для версии с ID

$category = intval( $row['category'] ); // Получаем ID только одной категории

$post_image = post_image($row['short_story']);

if (clean_url ( $_SERVER['HTTP_HOST'] ) != clean_url ( $config['http_home_url'] )) {
  $post_image = str_replace(clean_url ( $config['http_home_url'] ), clean_url ( $_SERVER['HTTP_HOST'] ), $post_image); // Проблема с выводм русскоязычных доменов, по этому домен заменяем на имя хоста т.е. на домен на котором находится сайт
}


$xfieldsdata = xfieldsdataload( $row[xfields] );


// Если картинка с часами есть - тогда мы её выводим
if (file_exists("uploads/chasy/{$xfieldsdata["art_interior"]}.jpg")) { // БЕЗ слэша в начале
$chasy = "http://best-kartina.ru/uploads/chasy/{$xfieldsdata["art_interior"]}.jpg";
}

// Если артикул интереров есть - выводим их
if(!empty($xfieldsdata["art_interior"])){
$url_interior1 = "http://best-kartina.ru/uploads/interior/1/{$xfieldsdata["art_interior"]}_interior_1.jpg";
$url_interior2 = "http://best-kartina.ru/uploads/interior/2/{$xfieldsdata["art_interior"]}_interior_2.jpg";
$url_interior3 = "http://best-kartina.ru/uploads/interior/3/{$xfieldsdata["art_interior"]}_interior_3.jpg";
$url_interior4 = "http://best-kartina.ru/uploads/interior/4/{$xfieldsdata["art_interior"]}_interior_4.jpg";
}


$rss_content .= <<<XML

            <offer id="{$row['id']}" available="false">
                <name>{$row['title']}</name>
                <pictures>
					<picture0>$post_image</picture0>
                	<picture1>$chasy</picture1>
                	<picture2>$url_interior1</picture2>
                	<picture3>$url_interior2</picture3>
                	<picture4>$url_interior3</picture4>
                	<picture5>$url_interior4</picture5>
                </pictures>
                <categoryId>$c_array[$category]</categoryId>
				<price>{$xfieldsdata["cena_m"]}</price>
                <article>{$xfieldsdata["art"]}</article>
				
				<var_xml>
					<variants>
						<variant>
							<price>{$xfieldsdata["cena_m"]}</price>
							<size>{$xfieldsdata["razmer_m"]}</size>
							<sku>{$xfieldsdata["art"]}-1</sku>
						</variant>
						<variant>
							<price>{$xfieldsdata["cena_l"]}</price>
							<size>{$xfieldsdata["razmer_l"]}</size>
							<sku>{$xfieldsdata["art"]}-2</sku>
						</variant>
						<variant>
							<price>{$xfieldsdata["cena_xl"]}</price>
							<size>{$xfieldsdata["razmer_xl"]}</size>
							<sku>{$xfieldsdata["art"]}-3</sku>
						</variant>
					</variants>
				</var_xml>
            </offer>
XML;

/*
                <oldprice>{$xfieldsdata["staraya_cena1"]}</oldprice>
                <description>Описание</description>
                <sales_notes>Необходима предоплата.</sales_notes>

*/


unset($category, $news_url, $post_image, $xfieldsdata, $chasy, $url_interior1, $url_interior2, $url_interior3, $url_interior4);
}




	
$rss_content .= <<<XML
        </offers>
    </shop>
</yml_catalog>
XML;

header( 'Content-type: application/xml' );
echo $rss_content;





@touch($file, time());
if (!empty($rss_content)){file_put_contents($file, $rss_content);}







?>