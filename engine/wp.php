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

			$cat_info = get_vars( "category" ); // ����� ��� ������ get_url

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

$images[0] = str_replace("thumbs/", "", $images[0]); // ������ ������ �� ������ �����������

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

$news_url = $config['http_home_url'] . get_url( intval( $row['category'] ) ) .'/'.$row['id'].'-'.$row['alt_name'].'.html'; // ��� ������ � ID

$category = intval( $row['category'] ); // �������� ID ������ ����� ���������

$post_image = post_image($row['short_story']);

if (clean_url ( $_SERVER['HTTP_HOST'] ) != clean_url ( $config['http_home_url'] )) {
  $post_image = str_replace(clean_url ( $config['http_home_url'] ), clean_url ( $_SERVER['HTTP_HOST'] ), $post_image); // �������� � ������ ������������� �������, �� ����� ����� �������� �� ��� ����� �.�. �� ����� �� ������� ��������� ����
}


$xfieldsdata = xfieldsdataload( $row[xfields] );

$rss_content .= <<<XML

            <offer id="{$row['id']}" available="false">
                <url>$news_url</url>
                <name>{$row['title']}</name>
                <picture>$post_image</picture>
                <categoryId>$c_array[$category]</categoryId>
                <price1>{$xfieldsdata["cena_m"]}</price1>
                <razmer1>{$xfieldsdata["razmer_m"]}</razmer1>
                
                <price2>{$xfieldsdata["cena_l"]}</price2>
                <razmer2>{$xfieldsdata["razmer_l"]}</razmer2>
                
                <price3>{$xfieldsdata["cena_xl"]}</price3>
                <razmer3>{$xfieldsdata["razmer_xl"]}</razmer3>

                <article>{$xfieldsdata["art"]}</article>
            </offer>
XML;

/*
                <oldprice>{$xfieldsdata["staraya_cena1"]}</oldprice>
                <description>��������</description>
                <sales_notes>���������� ����������.</sales_notes>

*/


unset($category, $news_url, $post_image, $xfieldsdata);
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