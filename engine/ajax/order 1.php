<?

define ("DATALIFEENGINE", "1");

include ENGINE_DIR.'/data/shop_conf.php';

$yaCounter_id = $shop_conf['yaCounter_id']; // ID Метрики
$to = $shop_conf['email']; // Почта, куда отправлять письмо
$My_time = gmdate('H:i', (time()+3*60*60));


if($_POST){

	$date_time = time();
	if (!empty ($_POST['timezone'])){$gmt = $_POST['timezone'] / -60;} // Получаем GMT

	$from = clean_url($config['http_home_url']); // название сайта (домен из конфига сайта)
	$data_type = $_POST['form'];
	$data_phone = $_POST['phone'];
	$data_name = $_POST['name'];
	$data_prod_id = $_POST['id'];
	$data_adress = $_POST['adress'];
	$data_comment = $_POST['comment'];
	$data_price = $_POST['price'];
	$data_email = $_POST['email'];
	$data_product_name = $_POST['product_name'];
	$data_tovar_img = $_POST['tovar_img'];
	
	// --- форматирование номера
	$zamena = array(" ","+","-","(",")");
	$data_phone = str_replace($zamena, "", $data_phone);

	if((strlen($data_phone) == 10) && ($data_phone[0] == 9)){
		$data_phone = "7" .$data_phone; // Добавляем первый символ в номере
	}elseif((strlen($data_phone) == 11) && ($data_phone[0] == 8)){
		$data_phone[0] = 7; // Заменяем первый символ в номере
	}
	// --- форматирование номера

// *************** Формирование письма
	$headers  = "Content-type: text/html; charset=windows-1251 \r\n";
//	$headers .= "From: $from@ya.ru\n";

	$date_time2 = gmdate('d.m.Y - H:i', ($row['date']+3*60*60)); // Получаем дату в GMT и прибавляем наш часовой пояс
	$subject ="Заказ на ".$from;
	
	$message ="
		<h2>Заказ на $from</h2>
		<br /> Дата и время- <span style='font-size:1.2em;'>$date_time2</span> 
		<br /> Имя - <span style='font-size:1.2em;'>".$data_name."</span>
		<br /> Телефон - <span style='font-size:1.2em;'>$data_phone</span>";

	if(!empty($data_email)){$message .="		<br /> E-mail - <span style='font-size:1.2em;'>$data_email</span>";}
	if(!empty($data_adress)){$message .="		<br /> Адрес - <span style='font-size:1.2em;'>$data_adress</span>";}
	if(!empty($data_comment)){$message .="		<br /> Комментарий - <span style='font-size:1.2em;'>$data_comment</span>";}
	if(!empty($data_prod_id)){$message .="		<br /> Код товара - <span style='font-size:1.2em;'>$data_prod_id</span>";}
	if(!empty($data_product_name)){$message .="		<br /> Товар - <span style='font-size:1.2em;'>$data_product_name</span>";}
	if(!empty($data_price)){$message .="		<br /> Цена товара - <span style='font-size:1.2em;'>$data_price руб.</span>";}
	$message .="		<br />";
// *************** Формирование письма

	if(!ctype_digit($data_phone) || strlen($data_phone) < 10 ){
		$result = '{error:"Не правильно указан номер телефона"}';
	
		$subject ="Ошибка на ".$from;
		mail($to, $subject, $message, $headers); 

	} else {
		
		mail($to, $subject, $message, $headers); 

		$db->super_query("INSERT INTO ".USERPREFIX."_zakazi (date,type,zakaz_read,name,phone,email,adress,comment,price,prod_id,tovar_img,product_name,vk_send_status,google_send_status,gmt) VALUES ('{$date_time}', '{$data_type}', '0', '{$data_name}', '{$data_phone}', '{$data_email}', '{$data_adress}', '{$data_comment}', '{$data_price}', '{$data_prod_id}', '{$data_tovar_img}', '{$data_product_name}', '0', '0', '{$gmt}')");
		
		$id = $db->insert_id;
		$result = '{result:{msg:"Ваш заказ принят", id:'.$id.'}}'; 
		// $(window).load(function() {yaCounter$yaCounter_id.reachGoal('$metka', {price: $data_price})});

	}
	
	echo $result;

}


/*
$result_title = "Заявка получена и уже обрабатывается";

$result = <<<HTML
<span style="font-size: 16px;">
    <p>Убедитесь, что ваш телефон включён! В ближайшие 2 часа с вами свяжется менеджер для оформления заказа</p>
    <p>Если Вы оставили заказ в не рабочее время, менеджер свяжется с Вами с 11:00 до 14:00 (сейчас в Москве $My_time)</p>
    <p>Если этого не произойдёт, пожалуйста перезвоните нам по бесплатному номеру 8 800 555 08 70</p>
</span>

<br><br><br>
<h2>Как повесить картину без сверления стен, всего за 10 минут!</h2>
<br>
<center><iframe width="640" height="360" src="https://www.youtube.com/embed/2wt8r32w6N8" frameborder="0" allowfullscreen></iframe></center>

$result2
HTML;
*/



?>
