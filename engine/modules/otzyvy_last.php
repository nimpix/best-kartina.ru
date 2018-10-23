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
<div class="rev-item">
	<div class="rev-top clearfix">
		<div class="rev-img">
			<img src="/uploads/fotos/$row[foto]" alt="">
		</div>
		<div class="rev-who">
			<div class="who"><a href="http://vk.com/id$row[uid]" target="_blank">$row[name]</a></div>
			<p>$age $row[city]</p>
			<div class="social">
				<a href="http://vk.com/id$row[uid]" target="_blank" class="vk"></a>
			</div>
		</div>
	</div>
	<p>$row[comment]</p>
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
