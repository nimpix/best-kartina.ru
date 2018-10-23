<?php

/*
function getNewsId() {
  $id = isset($_REQUEST['newsid']) ? intval($_REQUEST['newsid']) : false ;
  return $id;
}
*/



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





$id = isset($_REQUEST['newsid']) ? intval($_REQUEST['newsid']) : false ;



if (!empty ($id))
{
  $array = unserialize($_COOKIE["prosmotri"]);
  // print_r($array);
  if(!is_array($array)){
    $array = array();
  }
  if(isset($array[$id])){
      unset($array[$id]); // Удаляем из массива элемент и добавляем снова, что бы он выводился первым (если мы его уже просматривали)
  }

  $array[$id] = $id;

  if(count($array)>5){
    $array = array_slice($array, -5, 5, true); 
  }

  $new_ids = serialize($array);
  setcookie('prosmotri', $new_ids, time()+864000, "/");
}




$array1 = unserialize($_COOKIE["prosmotri"]);


$array1 =array_reverse($array1);

foreach($array1 as $k=>$v){

$array2[$v] = $v; // Задаём в качестве КЛЮЧА значение $v т.к. после реверса индексы пропали 
}


$string_ids = implode(",", $array2);


if (!empty ($string_ids))
{
    $result = $db->query( "SELECT `id`, `title`, `category`, `alt_name`, `short_story`, `xfields`, `approve` FROM `" . PREFIX . "_post` WHERE `id` IN ($string_ids) AND `approve` = 1" );


    while ($row = $db->get_row($result)) {

    $news_url = $config['http_home_url'] . get_url( intval( $row['category'] ) ) . '/' .$row['id'].'-'.$row['alt_name'].'.html'; // Для версии с ID
    //$news_url = $config['http_home_url'] . $row['alt_name'].'.html'; // Для версии без ID

    $post_image = post_image($row['short_story']);
      $post_image = str_replace($config['http_home_url'], "/", $post_image); // Проблема с выводм русскоязычных доменов, по этому домен просто вырезаем

    $xfieldsdata_price = xfieldsdataload( $row[xfields] );
    $new_price = $xfieldsdata_price[price];


    $array_tovar[$row['id']] = array("url"=>$news_url, "screen"=>$post_image, "title"=>$row['title'], "price"=>$new_price);


    unset($news_url, $post_image, $new_price);
    }


}




foreach($array2 as $k=>$v){

echo <<<HTML

<div class="view-item">
	<div class="cat-item">
		<h3><a href="{$array_tovar[$k]['url']}">{$array_tovar[$k]['title']}</a></h3>
		<div class="cat-img">
			<a href="{$array_tovar[$k]['url']}">
				<img src="/img/img.php?h=138&amp;w=213&amp;src={$array_tovar[$k]['screen']}" alt="">

HTML;
if (!empty($array_tovar[$k]['skidka'])) {
	echo <<<HTML
				<span class="discount">-{$array_tovar[$k]['skidka']}%</span>
HTML;
}

echo <<<HTML

			</a>
		</div>
		<div class="old_price">Старая цена: <span>{$array_tovar[$k]['price_old']}</span> руб.</div>
		<div class="new_price">Новая цена: <span>{$array_tovar[$k]['price']}</span> руб.</div>
	</div>
	<div class="cat-btns clearfix">
		<a href="{$array_tovar[$k]['url']}" class="btn btn-more">Подробнее</a>
		<input type="hidden" class="hidden-size" name="size" value="{$array_tovar[$k]['razmer_m']} см">
			<input type="hidden" class="hidden-id" name="id" value="{$array_tovar[$k]['id']}">
		<a href="" class="btn btn-order">Заказать</a>
	</div>
</div>

HTML;

}





// print_r($array_tovar);
















?>
