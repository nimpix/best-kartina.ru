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

   if ($spam_result === FALSE){ // �������� ������ � FALSE �.�. � ��������� ������ ��������� ����� �������� �� ���������


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
if (strlen ($bdate) > 5){// ���� ������ 6 - ��
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


$user_name = iconv("UTF-8", "CP1251", $array_j[first_name]); // ����� ���������
$user_city = iconv("UTF-8", "CP1251", $array_j[city]); // ����� ���������






if (empty ($user_email)){ // ���� email �� �������� ������������ ������� - ����� email �� ID � ��������
$user_email = $vk_uid."@vk.com";
}

if (!empty ($city)){ // ���� ����� �������� ������������ ������� - ����� ������ ���
$user_city = $city;
}


$user_age = $array_j[age];

if (!empty ($_POST['age'])){
$user_age = $_POST['age'];
}

$photo_big = $array_j[photo_big];


$date = time();



 $db->query("INSERT INTO `dle_otzivi` (`date`, `post_id`, `moderation`, `type`, `name`, `city`, `foto`, `email`, `uid`, `phone`, `age`, `photo_big`, `comment`) VALUES ('{$date}', '{$post_id}', '0', 'text', '{$user_name}', '{$user_city}', '{$filename}', '{$user_email}', '{$vk_uid}', '{$phone}', '{$user_age}', '{$photo_big}', '{$comment}')");






$result_title = "����� ��������";
$result = <<<HTML
    <p>�� �������� ��� ����� � ����� �������� �� �������� �� �����</p>
HTML;

	} else {

$result_title = "�� �� ������� ���� ��������";
$result = <<<HTML
    <p>������� email ��� ����� ����� �������� � ��������</p>
HTML;

}


   }else{
   
$result_title = "";
   
   }




} else { // ���� ������ �� �������� - ������� ������ ����� ��� �������

$result_title = "�������� ��� ����� � ����� �������� � ����� �������";
$result = <<<HTML
		
    <div class="review_block">
    <p>�� ������ ���� ����� ������ �.�. ��� �������� ��� ����������� � �������� �������� ������������</p>
    <p>��� �������� ������ �� ���� �������� vk.com - ���� ����������, ����� � ������� ����� �������� ������������� �.�. ��������� ��� ������ �� �����������</p><br>

<div class="form">
	<form name="myform" id="myform" method="POST">
		<div class="form-left">
			<div class="input">
				<input type="text" name="name" placeholder="���� ���">
			</div>
			<div class="input">
				<input type="text" name="age" placeholder="�������">
			</div>
			<div class="input">
				<input type="text" name="city" placeholder="�����">
			</div>
			<div class="input">
				<input type="tel" class="phone" name="phone" placeholder="������� � �������� ��� �������� �����">
			</div>
			<div class="input">
				<input type="text" name="vk_url" placeholder="������ �� ���� �������� vk.com">
			</div>
		</div>
		<div class="form-right">
			<div class="input">
				<textarea name="comment" placeholder="�����"></textarea>
			</div>
			<div class="input">
				<button type="submit">�������� �����</button>
			</div>
		</div>
	</form>
</div>

    </div>
HTML;

}













$tpl->set('{description}' , $result_title); // ���������
$tpl->set('{static}' , $result);
$tpl->set('{pages}' , "");
$tpl->load_template('static.tpl');
$tpl->compile('content');
$tpl->clear();


?>
