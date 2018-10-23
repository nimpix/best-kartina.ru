<?
header('Content-Type: text/html; charset=windows-1251');

//ini_set("display_errors",1);
error_reporting(0);

define( 'DATALIFEENGINE', true );
define( 'ROOT_DIR', substr( dirname(  __FILE__ ), 0, -12 ) );
define( 'ENGINE_DIR', ROOT_DIR . '/engine' );

include ENGINE_DIR . '/data/config.php';


require_once $_SERVER['DOCUMENT_ROOT'].'/engine/classes/mysql.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/engine/data/dbconfig.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/engine/modules/functions.php';

include $_SERVER['DOCUMENT_ROOT'].'/engine/data/shop_conf.php';

$yaCounter_id = $shop_conf['yaCounter_id']; // ID Метрики
$to = $shop_conf['email']; // Почта, куда отправлять письмо
// $to = 'worker.smartso@gmail.com'; // Почта, куда отправлять письмо
$My_time = gmdate('H:i', (time()+3*60*60));

if(($_POST['type'] == "print") || ($_POST['type'] == "design")){$to = "admin@best-kartina.ru";}

if($_POST){

		$date_time = time();
		if (!empty ($_POST['timezone'])){$gmt = $_POST['timezone'] / -60;} // Получаем GMT

		$from = 'best-kartina.ru'; // название сайта (домен из конфига сайта)
		$data_phone = $_POST['phone'];
		$ordername = iconv("UTF-8", "CP1251", $_POST['ordername']);
		$data_type = $_POST['type'];
		$options = iconv("UTF-8", "CP1251", $_POST['card_options']);
		$data_email = $_POST['email'];
		$data_comment = iconv("UTF-8", "CP1251", $_POST['message']);
		$data_name = iconv("UTF-8", "CP1251", $_POST['name']);
		$data_adress = iconv("UTF-8", "CP1251", $_POST['adress']);
		$data_prod_id = $_POST['id'];
		$data_prod_art = $_POST['art'];
		$data_price = iconv("UTF-8", "CP1251", $_POST['price']);
		$data_product_name = iconv("UTF-8", "CP1251", $_POST['product_name']);
		$data_tovar_img = $_POST['tovar_img'];
		$data_domain = $_SERVER['HTTP_HOST'];
		$data_order_utm = '';
		if(!empty($_POST['utm'])){
			$data_order_utm = $_POST['utm'];
		}


$_COOKIE['admitad_uid'] = $_COOKIE['_aid'];

		if(!empty($_COOKIE['admitad_uid'])){
			$admitad = $_COOKIE['admitad_uid'];
		}



$zamena = array(" ","+","-","(",")");
$data_phone = str_replace($zamena, "", $data_phone);


	// *************** Формирование письма
		$headers  = "Content-type: text/html; charset=windows-1251 \r\n";
	//	$headers .= "From: $from@ya.ru\n";

		$date_time2 = gmdate('d.m.Y - H:i', ($date_time+3*60*60)); // Получаем дату в GMT и прибавляем наш часовой пояс
		$subject =$ordername. " на " .$from;
		
		$message ="
			<h2>$ordername на $from</h2>
			<br /> Дата и время- <span style='font-size:1.2em;'>$date_time2</span> 
			<br /> Имя - <span style='font-size:1.2em;'>".$data_name."</span>
			<br /> Телефон - <span style='font-size:1.2em;'>$data_phone</span>";

		if(!empty($data_email)){$message .="		<br /> E-mail - <span style='font-size:1.2em;'>$data_email</span>";}
		if(!empty($data_adress)){$message .="		<br /> Адрес - <span style='font-size:1.2em;'>$data_adress</span>";}
		if(!empty($data_comment)){$message .="		<br /> Комментарий - <span style='font-size:1.2em;'>$data_comment</span>";}
		if(!empty($data_prod_id)){$message .="		<br /> Код товара - <span style='font-size:1.2em;'>$data_prod_id</span>";}
		if(!empty($data_product_name)){$message .="		<br /> Товар - <span style='font-size:1.2em;'>$data_product_name</span>";}
		if(!empty($data_price)){$message .="		<br /> Цена товара - <span style='font-size:1.2em;'>$data_price</span>";}
		if(!empty($options)){$message .="		<br /> Дополнительно: - <span style='font-size:1.2em;'>$options</span>";}
		if(!empty($data_price)){$message .="		<br /> Картинка товара - <span style='font-size:1.2em;'>$data_tovar_img</span>";}
		$message .="		<br />";
	// *************** Формирование письма
			
	// mail($to, $subject, $message, $headers);

	include $_SERVER['DOCUMENT_ROOT'].'/engine/ajax/phpmailer.php';// подключаем класс

    $mail = new PHPMailer();
    $mail->CharSet = 'windows-1251';
    $mail->SetLanguage('ru');
    $mail->From = $from;
    $mail->FromName = $from;
    $mail->isHTML(true);
    $mail->AddAddress($to);
    $mail->Subject = $subject;

    if(isset($_FILES['file1']))
    {
    if($_FILES['file1']['error'] == 0)
    {
    $mail->AddAttachment($_FILES['file1']['tmp_name'],$_FILES['file1']['name']);
    }
    }
    if(isset($_FILES['file2']))
    {
    if($_FILES['file2']['error'] == 0)
    {
    $mail->AddAttachment($_FILES['file2']['tmp_name'],$_FILES['file2']['name']);
    }
    }
    if(isset($_FILES['file3']))
    {
    if($_FILES['file3']['error'] == 0)
    {
    $mail->AddAttachment($_FILES['file3']['tmp_name'],$_FILES['file3']['name']);
    }
    }
    $mail->Body = $message;
    $mail->Send();
	
	@$db->super_query("INSERT INTO ".USERPREFIX."_zakazi (date, type, zakaz_read, name ,phone, adress ,price ,prod_id ,prod_art ,tovar_img ,product_name ,vk_send_status ,google_send_status ,gmt, utm, domain, options, admitad) VALUES ('{$date_time}', '{$data_type}', '0', '{$data_name}', '{$data_phone}', '{$data_adress}', '{$data_price}', '{$data_prod_id}', '{$data_prod_art}', '{$data_tovar_img}', '{$data_product_name}', '0', '0', '{$gmt}', '{$data_order_utm}', '{$data_domain}', '{$options}', '{$admitad}')");
	
	$id = $db->insert_id();

	$result = '{"result":{"msg":"Ваш заказ принят", "id":'.$id.', "type" : "'.$_POST["type"].'"}}'; 

	echo $result;




		if(!empty($_COOKIE['admitad_uid'])){
			$admitad = $_COOKIE['admitad_uid'];
@file_get_contents("http://ad.admitad.com/r?campaign_code=530976f02a&action_code=1&payment_type=sale&response_type=img&uid=$admitad&tariff_code=1&order_id=$id&position_id=1&currency_code=RUB&position_count=1&price=$data_price&quantity=1&product_id=$data_prod_id");
		}


}

?>
