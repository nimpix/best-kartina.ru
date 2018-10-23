<?


define ("DATALIFEENGINE", "1");
define ( 'ROOT_DIR', dirname ( __FILE__ ) );
define ( 'ENGINE_DIR', ROOT_DIR . '/engine' );

require_once ROOT_DIR . '/engine/init.php';





$vk_url = $_POST['vk_url'];
$comment = $_POST['comment'];
$user_name = $_POST['name'];
$user_email = $_POST['email'];
$user_age = $_POST['age'];
$user_city = $_POST['city'];
$phone = $_POST['phone'];


$date = time();

	if(!empty($_POST)){

   $substr = "http";
   $spam_result = strripos ($comment, $substr);

   if ($spam_result === FALSE){ // Работает только с FALSE т.к. в противнос случае выводится число символов до вхождения


	if(!empty($vk_url) || !empty($user_email)){
	

$zamena = array("http://vk.com/id","https://vk.com/id","vk.com/id");
$vk_uid = str_replace($zamena, "", $vk_url);
$vk_url = "http://vk.com/id".$vk_uid;


$url_profile = "http://api.vk.com/method/users.get?uid=".$vk_uid."&lang=ru&fields=bdate,city,photo_medium,photo_big";

 $json = file_get_contents($url_profile);

 $array_j = json_decode($json, TRUE);
 $array_j = $array_j[response][0];

if (!empty ($array_j[city])){
$json2 = file_get_contents("http://api.vk.com/method/getCities?cids=".$array_j[city]);

$array_j2 = json_decode($json2, TRUE);
 $array_j2 = $array_j2[response][0];
 
 $array_j[city] = $array_j2[name];
}


$bdate = $array_j[bdate];
if (strlen ($bdate) > 5){// если меньше 6 - не
$bdate = strtotime($bdate);
$age1 = time() - $bdate;
$array_j[age] = round($age1/31536000);

// echo date( 'Y-m-d H:i:s', $age );
}



 $filename = basename($array_j[photo_medium]);
 
$avatar_path = ROOT_DIR."/uploads/fotos/";
 
 if (!file_exists($avatar_path.$filename)){

        $str = file_get_contents($array_j[photo_medium]);

if (!empty ($str)){

        $file = fopen($avatar_path.$filename, 'w');
         fwrite($file, $str);
         fclose($file);
}

}


$user_name = iconv("UTF-8", "CP1251", $array_j[first_name]); // смена кодировки
$user_city = iconv("UTF-8", "CP1251", $array_j[city]); // смена кодировки






if (empty ($user_email)){ // если email не заполнен пользователм вручную - пишем email из ID в контакте
$user_email = $vk_uid."@vk.com";
}

if (!empty ($city)){ // если город заполнен пользователм вручную - пишем именно его
$user_city = $city;
}


$user_age = $array_j[age];

if (!empty ($_POST['age'])){
$user_age = $_POST['age'];
}

$photo_big = $array_j[photo_big];


$date = time();



 $db->query("INSERT INTO `dle_otzivi` (`date`, `post_id`, `moderation`, `type`, `name`, `city`, `foto`, `email`, `uid`, `phone`, `age`, `photo_big`, `comment`) VALUES ('{$date}', '{$post_id}', '0', 'text', '{$user_name}', '{$user_city}', '{$filename}', '{$user_email}', '{$vk_uid}', '{$phone}', '{$user_age}', '{$photo_big}', '{$comment}')");






$result_title = "Отзыв оставлен";
$result = <<<HTML
    <p>Мы получили ваш отзыв и после проверки он появится на сайте</p>
HTML;

	} else {

$result_title = "Вы не указали свои контакты";
$result = <<<HTML
    <p>Укажите email или адрес своей страницы в контакте</p>
HTML;

}


   }else{
   
$result_title = "";
   
   }




} else { // Если ничего не передали - выводим только форму для отзывов

$result_title = "Оставьте Ваш отзыв о наших картинах и наших услугах";
$result = <<<HTML
		
    <div class="review_block">
    <p>Мы всегда рады вашим отзыва т.к. это помогает нам развиваться и улучшать качество обслуживания</p>
    <p>При указании ссылки на вашу страницу vk.com - ваша фотография, город и возраст будут получены автоматически т.е. заполнять эти данные не обязательно</p><br>

<div class="form">
	<form name="myform" id="myform" method="POST">
		<div class="form-left">
			<div class="input">
				<input type="text" name="name" placeholder="Ваше имя">
			</div>
			<div class="input">
				<input type="text" name="age" placeholder="Возраст">
			</div>
			<div class="input">
				<input type="text" name="city" placeholder="Город">
			</div>
			<div class="input">
				<input type="tel" class="phone" name="phone" placeholder="Телефон с которого был оформлен заказ">
			</div>
			<div class="input">
				<input type="text" name="vk_url" placeholder="Ссылка на вашу страницу vk.com">
			</div>
		</div>
		<div class="form-right">
			<div class="input">
				<textarea name="comment" placeholder="Отзыв"></textarea>
			</div>
			<div class="input">
				<button type="submit">Оставить отзыв</button>
			</div>
		</div>
	</form>
</div>

    </div>
HTML;

}













$tpl->set('{description}' , $result_title); // Заголовок
$tpl->set('{static}' , $result);
$tpl->set('{pages}' , "");
$tpl->load_template('static.tpl');
$tpl->compile('content');
$tpl->clear();


?>
