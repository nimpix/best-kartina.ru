<?


if (file_exists(ENGINE_DIR.'/data/kupili.txt')){ // Если файл существует
$array_tovar = unserialize(file_get_contents(ENGINE_DIR.'/data/kupili.txt'));




echo <<<HTML

    <script type="text/javascript" src="/templates/{$config['skin']}/js/jquery.timeago.js"></script>
    <script type="text/javascript" src="/templates/{$config['skin']}/js/jquery.timeago.ru.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            jQuery("abbr.timeago").timeago();
        });
    </script>

HTML;




foreach ($array_tovar as $row) {


$date = date( 'Y-m-d\TH:i:s', $row[date] );

echo <<<HTML
                 <div class="justbuy_one">
                    <div class="jbuy_imgside">
                    <a href="$row[url]"><img class="jbuy_img" src="/img/img.php?h=110&w=110&src=$row[screen]" /></a>
                    </div>
                       <div class="jbuy_cont">
                             <a href="$row[url]" class="justbuy_link">$row[title]</a>
                              <span class="jb_price">$row[price] руб.</span>
                              <span class="jb_time"><abbr class="timeago" title="$date"></abbr></span>
                        </div>
                        <div class="clear"></div>
                 </div>
HTML;

}





}

?>