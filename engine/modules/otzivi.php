<?


function to_normal_alt ($alt) {
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

// запятая перенесена сюда, что бы не вылазила,к когда возраст не указан




$result = $db->query("SELECT uid, moderation, name, foto, city, age, comment FROM dle_otzivi WHERE dle_otzivi.moderation = 1 ORDER BY dle_otzivi.id DESC LIMIT 10");


while ($row = $db->get_array($result)) {



$age = "";
if (!empty ($row[age])){
$age = $row[age].to_normal_alt($row[age]);
}





echo <<<HTML
              <div class="sreview_one">
                   <a title="$row[name]"  href="http://vk.com/id$row[uid]"  onclick="return !window.open(this.href)"><img class="savatar" src="/uploads/fotos/$row[foto]" alt="" /></a>
                   <div class="sreview_details">
                      <a href="http://vk.com/id$row[uid]" onclick="return !window.open(this.href)">$row[name]</a>
                      <p> $age $row[city] </p>
                      <a href="http://vk.com/id$row[uid]" onclick="return !window.open(this.href)"><span class="sreview_vk"></span></a>
                   </div>
                   
                   <div class="clear"></div>
                   
                   <div class="sreview_some">$row[comment]</div>
              </div>
HTML;

}


echo <<<HTML

<a class="write_new" href="/review.html" rel="review">Оставить отзыв</a>
<a class="read_reviews_all" href="/otzyvy.html">Читать все</a>
<div class="clear"></div>

HTML;






 
?>