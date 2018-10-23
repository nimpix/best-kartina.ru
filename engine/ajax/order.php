<?
header('Content-Type: text/html; charset=windows-1251');

ini_set("display_errors",1);
error_reporting(E_ALL);

define( 'DATALIFEENGINE', true );
define( 'ROOT_DIR', substr( dirname(  __FILE__ ), 0, -12 ) );
define( 'ENGINE_DIR', ROOT_DIR . '/engine' );

include ENGINE_DIR . '/data/config.php';


require_once $_SERVER['DOCUMENT_ROOT'].'/engine/classes/mysql.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/engine/data/dbconfig.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/engine/modules/functions.php';

include $_SERVER['DOCUMENT_ROOT'].'/engine/data/shop_conf.php';

$yaCounter_id = $shop_conf['yaCounter_id']; // ID �������
$to = $shop_conf['email']; // �����, ���� ���������� ������
$My_time = gmdate('H:i', (time()+3*60*60));


if($_POST){

	if($_POST['order_step']==1){

		$date_time = time();
		if (!empty ($_POST['timezone'])){$gmt = $_POST['timezone'] / -60;} // �������� GMT

		$from = 'best-kartina.ru'; // �������� ����� (����� �� ������� �����)
		$data_type = $_POST['form'];
		$data_phone = $_POST['phone'];
		$data_name = iconv("UTF-8", "CP1251", $_POST['name']);
		$data_prod_id = $_POST['id'];
		$data_price = $_POST['price'];
		$data_product_name = iconv("UTF-8", "CP1251", $_POST['product_name']);
		$data_tovar_img = $_POST['tovar_img'];
		$data_domain = $_SERVER['HTTP_HOST'];
		$data_order_utm = '';
		if(!empty($_POST['utm'])){
			$data_order_utm = $_POST['utm'];
		}
		
		// --- �������������� ������
		$zamena = array(" ","+","-","(",")");
		$data_phone = str_replace($zamena, "", $data_phone);

		if((strlen($data_phone) == 10) && ($data_phone[0] == 9)){
			$data_phone = "7" .$data_phone; // ��������� ������ ������ � ������
		}elseif((strlen($data_phone) == 11) && ($data_phone[0] == 8)){
			$data_phone[0] = 7; // �������� ������ ������ � ������
		}
		// --- �������������� ������

	// *************** ������������ ������
		$headers  = "Content-type: text/html; charset=windows-1251 \r\n";
	//	$headers .= "From: $from@ya.ru\n";

		$date_time2 = gmdate('d.m.Y - H:i', ($date_time+3*60*60)); // �������� ���� � GMT � ���������� ��� ������� ����
		$subject ="����� �� ".$from;
		
		$message ="
			<h2>����� �� $from</h2>
			<br /> ���� � �����- <span style='font-size:1.2em;'>$date_time2</span> 
			<br /> ��� - <span style='font-size:1.2em;'>".$data_name."</span>
			<br /> ������� - <span style='font-size:1.2em;'>$data_phone</span>";

		if(!empty($data_email)){$message .="		<br /> E-mail - <span style='font-size:1.2em;'>$data_email</span>";}
		if(!empty($data_adress)){$message .="		<br /> ����� - <span style='font-size:1.2em;'>$data_adress</span>";}
		if(!empty($data_comment)){$message .="		<br /> ����������� - <span style='font-size:1.2em;'>$data_comment</span>";}
		if(!empty($data_prod_id)){$message .="		<br /> ��� ������ - <span style='font-size:1.2em;'>$data_prod_id</span>";}
		if(!empty($data_product_name)){$message .="		<br /> ����� - <span style='font-size:1.2em;'>$data_product_name</span>";}
		if(!empty($data_price)){$message .="		<br /> ���� ������ - <span style='font-size:1.2em;'>$data_price ���.</span>";}
		$message .="		<br />";
	// *************** ������������ ������

		if(!ctype_digit($data_phone) || strlen($data_phone) < 10 ){
			$result = '{"error":"�� ��������� ������ ����� ��������"}';
		
			$subject ="������ �� ".$from;
			mail($to, $subject, $message, $headers); 

		} else {
			
				mail($to, $subject, $message, $headers);
				
				@$db->super_query("INSERT INTO ".USERPREFIX."_zakazi (date, type, zakaz_read, name ,phone ,price ,prod_id ,tovar_img ,product_name ,vk_send_status ,google_send_status ,gmt, utm, domain) VALUES ('{$date_time}', '{$data_type}', '0', '{$data_name}', '{$data_phone}', '{$data_price}', '{$data_prod_id}', '{$data_tovar_img}', '{$data_product_name}', '0', '0', '{$gmt}', '{$data_order_utm}', '{$data_domain}')");
				
				$id = $db->insert_id();

				$result = '{"result":{"msg":"��� ����� ������", "id":'.$id.'}}'; 

		}

	}elseif($_POST['order_step']==2){
		
		$data_zak_id = $_POST['zak_id'];
		$data_adress = ($_POST['adress']) ? iconv("UTF-8", "CP1251", $_POST['adress']):'';
		$data_comment = ($_POST['comment']) ? iconv("UTF-8", "CP1251", $_POST['comment']):'';
		$data_phone = $_POST['phone'];
		$data_name = iconv("UTF-8", "CP1251", $_POST['name']);
		
		// --- �������������� ������
		$zamena = array(" ","+","-","(",")");
		$data_phone = str_replace($zamena, "", $data_phone);

		if((strlen($data_phone) == 10) && ($data_phone[0] == 9)){
			$data_phone = "7" .$data_phone; // ��������� ������ ������ � ������
		}elseif((strlen($data_phone) == 11) && ($data_phone[0] == 8)){
			$data_phone[0] = 7; // �������� ������ ������ � ������
		}
		// --- �������������� ������
		
		if(!ctype_digit($data_phone) || strlen($data_phone) < 10 ){
			$result = '{"error":"�� ��������� ������ ����� ��������"}';
		
		} else {
			@$db->super_query("UPDATE ".USERPREFIX."_zakazi SET  name='{$data_name}',phone='{$data_phone}', adress='{$data_adress}', comment='{$data_comment}' WHERE id={$data_zak_id}");
			
			$result = '{"result":{"msg":"��� ����� ��������!"}}'; 
		}
	}
	
	echo $result;

}


/*
 * 			$db->super_query("INSERT INTO ".USERPREFIX."_zakazi (date,type,zakaz_read,name,phone,email,adress,comment,price,prod_id,tovar_img,product_name,vk_send_status,google_send_status,gmt) VALUES ('{$date_time}', '{$data_type}', '0', '{$data_name}', '{$data_phone}', '{$data_email}', '{$data_adress}', '{$data_comment}', '{$data_price}', '{$data_prod_id}', '{$data_tovar_img}', '{$data_product_name}', '0', '0', '{$gmt}')");

$result_title = "������ �������� � ��� ��������������";

$result = <<<HTML
<span style="font-size: 16px;">
    <p>���������, ��� ��� ������� �������! � ��������� 2 ���� � ���� �������� �������� ��� ���������� ������</p>
    <p>���� �� �������� ����� � �� ������� �����, �������� �������� � ���� � 11:00 �� 14:00 (������ � ������ $My_time)</p>
    <p>���� ����� �� ���������, ���������� ����������� ��� �� ����������� ������ 8 800 555 08 70</p>
</span>

<br><br><br>
<h2>��� �������� ������� ��� ��������� ����, ����� �� 10 �����!</h2>
<br>
<center><iframe width="640" height="360" src="https://www.youtube.com/embed/2wt8r32w6N8" frameborder="0" allowfullscreen></iframe></center>

$result2
HTML;
*/



?>
