<?


function to_normal_alt ($alt) {
    $alt = intval($alt);

  if(strlen($alt) == '1') $vt = $alt;
           else 
         $vt = substr($alt, -1);

  if($vt == '0') $p = ' ���, ';
  elseif($vt == '1') $p = ' ���, ';
  elseif($vt <= '4') $p = ' ����, ';
  else $p = ' ���, '; 
  return $p;
}

// ������� ���������� ����, ��� �� �� ��������,� ����� ������� �� ������




$result = $db->query("SELECT uid, moderation, name, foto, city, age, comment FROM dle_otzivi WHERE dle_otzivi.moderation = 1 ORDER BY dle_otzivi.id DESC LIMIT 3");


while ($row = $db->get_array($result)) {



$age = "";
if (!empty ($row[age])){
$age = $row[age].to_normal_alt($row[age]);
}





echo <<<HTML
              <div class="column-4">
                <div class="rev-item">
                  <div class="rev-top clearfix">
                    <div class="rev-img">
                      <a href="http://vk.com/id$row[uid]">
                        <img src="/uploads/fotos/$row[foto]" alt="">
                      </a>
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
                  <a href="/otzyvy.html" class="link">������ ���� �����</a>
                </div>
              </div>
HTML;

}

?>