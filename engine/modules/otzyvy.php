<?




define ("DATALIFEENGINE", "1");
define ( 'ROOT_DIR', dirname ( __FILE__ ) );
define ( 'ENGINE_DIR', ROOT_DIR . '/engine' );

require_once ROOT_DIR . '/engine/init.php';





function to_normal_alt1 ($alt) {
    $alt = intval($alt);

  if(strlen($alt) == '1') $vt = $alt;
           else 
         $vt = substr($alt, -1);

  if($vt == '0') $p = ' лет, ';
  elseif($vt == '1') $p = ' год, ';
  elseif($vt <= '4') $p = ' года, ';
  else $p = ' лет, '; 
  return $p;
}



$result_zapros = $db->query("SELECT uid, moderation, name, foto, city, age, comment FROM dle_otzivi WHERE dle_otzivi.moderation = 1 ORDER BY dle_otzivi.id DESC LIMIT 70");

while ($row = $db->get_array($result_zapros)) {

$age = "";
if (!empty ($row[age])){
$age = $row[age].to_normal_alt1($row[age]);
}


$otzyv .= <<<HTML
<div class="RSWS_testi2_block">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="RSWS_testi_main">
	<tbody>
	<tr>
		<td valign="top" align="left">
			<img class="RSWS_testi_img" src="/uploads/fotos/$row[foto]" style="width:100px; height: 100px;">
		</td>
		<td valign="top" align="left">
			<div class="RSWS_testimonial">
				<span class="RSWS_left_quote">«</span><span>$row[comment]</span><span class="RSWS_right_quote">»</span>
			</div>
			<div class="RSWS_testmonial_subtext">
				$row[name], $age $row[city]
			</div>
		</td>
	</tr>
	</tbody>
	</table>
</div>
HTML;

}




$result_title = "Отзывы покупателей";
$result = <<<HTML
{$otzyv}
<br>
<a href="/review.html" class="review_bt"></a>
HTML;











$tpl->set('{description}' , $result_title); // Заголовок
$tpl->set('{static}' , $result);
$tpl->set('{pages}' , "");
$tpl->load_template('static.tpl');
$tpl->compile('content');
$tpl->clear();



?>
