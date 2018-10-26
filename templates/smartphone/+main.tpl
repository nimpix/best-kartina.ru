<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>

{headers}

<link rel="shortcut icon" href="{THEME}/img/favicon.ico" />

<!-- Main site Js/css-->
<link media="screen" href="{THEME}/style/main.css" type="text/css" rel="stylesheet" />
<link media="screen" href="{THEME}/style/engine.css" type="text/css" rel="stylesheet" />
<link media="screen" href="{THEME}/style/reviews.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="{THEME}/js/added.js"></script>
<script type="text/javascript" src="{THEME}/js/os.js"></script>
<script type="text/javascript" src="{THEME}/js/libs.js"></script>
<!-- Main site Js/css-->

<!-- Timer-->
<link rel="stylesheet" href="{THEME}/timer/style.css">
<script type="text/javascript" src="{THEME}/timer/js/script.js"></script>
<script type="text/javascript" src="{THEME}/timer/js/jquery.cookie.js"></script>
<!-- Timer-->

<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->

[aviable=showfull]

<!-- Sliderkit JS/ CSS-->
<script type="text/javascript" src="{THEME}/js/sliderkit/jquery.easing.1.3.min.js"></script>
<script type="text/javascript" src="{THEME}/js/sliderkit/jquery.sliderkit.1.9.2.pack.js"></script>
<link rel="stylesheet" type="text/css" href="{THEME}/js/sliderkit/sliderkit.css" media="screen, projection" />

		<!-- Slider Kit launch -->
		<script type="text/javascript">
			$(window).load(function(){ //$(window).load() must be used instead of $(document).ready() because of Webkit compatibility		
				
				// Photo slider > Minimal
				$(".contentslider-std").sliderkit({
					auto:1,
					tabs:1,
					circular:1,
					panelfx:"sliding",
					panelfxfirst:"fading",
					panelfxeasing:"easeInOutExpo",
					fastchange:1,
					autospeed:3000,
					keyboard:1
				});
				
			});	
		</script>
        
<!-- Sliderkit JS/ CSS-->
[/aviable]

<!-- popup fullstory imgs view -->
<link media="screen" href="{THEME}/style/fancy_lib.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="{THEME}/js/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        $('.jbgallery').fancybox({
            helpers:{
                "title"  : { type : "outside" },
                "buttons": { position:"top" },
                "thumbs" : { width :80, height:80 }
            }
        });
    });
</script>
<!-- popup fullstory imgs view -->

	<script src="{THEME}/js/jquery.textPlaceholder.js"></script>
	<script type="text/javascript">
	$(function(){
		$("input#placeholder, textarea#placeholder").textPlaceholder();
	});
	</script>

</head>
<body>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter27000663 = new Ya.Metrika({id:27000663,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/27000663" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

{AJAX}

<!-- Header Block -->
<div class="header_bl"> 
       <div class="centri">
            <a href="/" class="logo"><span>Фирменный магазин наушников</span></a>
                 <ul class="header_phones">
                     <li><span class="city">Москва</span><span class="mobile">+7 (495) 215 58 70</span></li>
                     <li class="secondary"><span class="city">Россия (звонок бесплатный!)</span><span class="mobile">+7 (800) 555 08 70</span></li>
                 </ul>
             <div class="clear"></div>
                 <div class="worktime">Мы работаем круглосуточно и без выходных</div>
                 
                   <div class="callback_bl">
                       <div class="callback_arrow"></div>
                       <a class="callback_button other" onclick="yaCounter27000663.reachGoal('call_me'); return true;">Перезвоните мне</a>
                   
                   </div>
              <div class="clear"></div>
       </div>
</div>
<!-- Header Block -->

<!-- TopMenu -->
{include file="topmenu.tpl"}
<!-- TopMenu -->

<!-- First News Block -->
<div class="first_news">
   <div class="centri">
   
   
   <!-- One Content Part -->
   <div class="romb_one">
            <div class="romb_news[category=16] active[/category]">
                      <div class="romb_news_cont">
                    <a href="/monster-beats-studio-2/#akcii"><img src="{THEME}/img/romb_studio_2.png" /></a>
                      </div>
             
            </div>
             <div class="clear"></div>
                    <a href="/monster-beats-studio-2/#akcii" class="first_title">Studio 2.0</a>
                    <span>ОТ 6290 р.</span>
    </div>
    <!-- One Content Part -->
    
    <!-- One Content Part -->
   <div class="romb_one">
            <div class="romb_news[category=17] active[/category]">
                      <div class="romb_news_cont">
                    <a href="/studio-wireless/#akcii"><img src="{THEME}/img/romb_studio_wireless.png" /></a>
                      </div>
             
            </div>
             <div class="clear"></div>
                    <a href="/studio-wireless/#akcii" class="first_title">Studio Wireless</a>
                    <span>ОТ 7890 р.</span>
    </div>
    <!-- One Content Part -->
    
   <!-- One Content Part -->
   <div class="romb_one">
            <div class="romb_news[category=19] active[/category]">
                      <div class="romb_news_cont">
                    <a href="/solo-matte/#akcii"><img src="{THEME}/img/romb_solo_matte.png" /></a>
                      </div>
             
            </div>
             <div class="clear"></div>
                    <a href="/solo-matte/#akcii" class="first_title">Solo Matte</a>
                    <span>ОТ 4490 р.</span>
    </div>
    <!-- One Content Part -->
    
   <!-- One Content Part -->
   <div class="romb_one">
            <div class="romb_news[category=12] active[/category]">
                      <div class="romb_news_cont">
                    <a href="/monster-beats-wireless/#akcii"><img src="{THEME}/img/romb_wireless.png" /></a>
                      </div>
             
            </div>
             <div class="clear"></div>
                    <a href="/monster-beats-wireless/#akcii" class="first_title">Wireless</a>
                    <span>ОТ 5190 р.</span>
    </div>
    <!-- One Content Part -->
    
   <!-- One Content Part -->
   <div class="romb_one">
            <div class="romb_news[category=13] active[/category]">
                      <div class="romb_news_cont">
                    <a href="/monster-beats-pro/#akcii"><img src="{THEME}/img/romb_pro.png" /></a>
                      </div>
             
            </div>
             <div class="clear"></div>
                    <a href="/monster-beats-pro/#akcii" class="first_title">PRO</a>
                    <span>ОТ 4890 р.</span>
    </div>
    <!-- One Content Part -->
    
   <!-- One Content Part -->
   <div class="romb_one">
            <div class="romb_news[category=14] active[/category]">
                      <div class="romb_news_cont">
                    <a href="/monster-beats-executive/#akcii"><img src="{THEME}/img/romb_executive.png" /></a>
                      </div>
             
            </div>
             <div class="clear"></div>
                    <a href="/monster-beats-executive/#akcii" class="first_title">Executive</a>
                    <span>ОТ 5590 р.</span>
    </div>
    <!-- One Content Part -->
    
   <!-- One Content Part -->
   <div class="romb_one">
            <div class="romb_news[category=6] active[/category]">
                      <div class="romb_news_cont">
                    <a href="/beats-urbeats-controltalk/#akcii"><img src="{THEME}/img/romb_urbeats.png" /></a>
                      </div>
             
            </div>
             <div class="clear"></div>
                    <a href="/beats-urbeats-controltalk/#akcii" class="first_title">UrBeats</a>
                    <span>ОТ 2290 р.</span>
    </div>
    <!-- One Content Part -->
    
    
   <!-- One Content Part -->
   <div class="romb_one">
            <div class="romb_news[category=1] active[/category]">
                      <div class="romb_news_cont">
                    <a href="/monster-beats-tour-2013/#akcii"><img src="{THEME}/img/romb_tour_2013.png" /></a>
                      </div>
             
            </div>
             <div class="clear"></div>
                    <a href="/monster-beats-tour-2013/#akcii" class="first_title">Tour 2013</a>
                    <span>ОТ 2790 р.</span>
    </div>
    <!-- One Content Part -->
    
    
    
          <div class="clear"></div>
    </div>
</div>
<!-- First News Block -->

<!-- Head First Content -->
<div class="fhead">
   <div class="centri" style="text-align:center;">
        <div class="fhead_cont">Хиты продаж</div>
   </div>
</div>
<!-- Head First Content -->

<!-- Special Block -->
<div class="special_bl" id="akcii">
     <div class="centri special_width">
          
          <div class="speci1">
               <p class="stext1" style="min-width: 187px;">Быстрая Доставка</p>
               <p class="stext4">Доставка по<br /> <span>России от 2х дней</span>
               </p>
               <p class="stext4" style="min-width: 175px;">Хотите мы оплатим <span>50%</span> стоимости доставки?
               <br />
               <a href="/dostavka.html#50" class="stext_link red" onsubmit="yaCounter27000663.reachGoal('hochu'); return true;">Хочу!</a></p>
               
               <p class="stext3"><span>Тест драйв</span></p>
               <p class="stext4">Опробуйте наушники<br /> перед покупкой!
               <br />
                <a href="/akcii.html#test_drive" class="stext_link" onsubmit="yaCounter27000663.reachGoal('poprobovat'); return true;">попробовать</a>
               </p>
               
               <p class="stext2">Доставка по Москве<br /> и Санкт-Петербургу<br />за 4 часа!
               <br />
               <a href="/dostavka.html#msk_spb" class="stext_link red" onsubmit="yaCounter27000663.reachGoal('besplatno'); return true;">заказать</a>
               </p>
               
               <div class="speci_map"></div>
          </div>
          
          <div class="speci2"> <div class="speci_gift"></div>
          
          <div class="specifl1">В подарок<br />при покупке<br />от 7000р.</div>
          <div class="specifl2">В подарок<br />при покупке<br />от 3000р</div>
          <div class="specifl3">В подарок<br />к каждому<br />заказу!</div>
          
          </div>
          
          <div class="speci3"> <div class="clear"></div>
            <p class="sakci"></p>
            
            <p class="timer">
            
            
<div class="timer">
               <div class="toend">До конца акции:</div>
						<div class="frame">
<span class="count_time_1"><img src="{THEME}/timer/images/flipper02.png" /></span>	
<span class="count_time_2"><img src="{THEME}/timer/images/flipper02.png" /></span>
<span class="count_time_3"><img src="{THEME}/timer/images/flipper02.png" /></span>
<span class="count_time_4"><img src="{THEME}/timer/images/flipper02.png" /></span>
<span class="count_time_5"><img src="{THEME}/timer/images/flipper02.png" /></span>
<span class="count_time_6"><img src="{THEME}/timer/images/flipper02.png" /></span>
						</div>
                        
                        <div class="toend_hours">Часов</div>
                        <div class="toend_minutes">Минут</div>
                        <div class="toend_seconds">Секунд</div>
</div>  
            </p>
            
            <p class="grtsome_gift"></p>
            
            
          </div>
          
          <div class="speci4">   <div class="greet_rules_bag"></div>
             <p class="greet_rules_head">Только сегодня</p>
               <ul>
                  <li>Стильный mp3</li>
                  <li>Наушники Beats Tour</li>
                  <li>Мини колонка BeatBox</li>
               </ul>
          </div>
          
          <div class="speci5">
           <p>рст, прямая</p><p>поставка в россию</p>
           <p style="padding-top:14px;"><a href="/uploads/cert_big.jpg" class="jbgallery"><img src="{THEME}/img/sertificat.jpg" alt="" /></a></p>
          </div>
          
     </div>
      <div class="clear"></div>
</div>
<!-- Special Block -->


<!-- Main Content Block-->
<div class="main_colour_container[not-aviable=main|cat|tags] fullbg[/not-aviable]">

<div class="main_content_block" id="tovar">
    <!-- Content Left Side -->
    <div class="cont_left_side">
    
           <!-- News Block -->
           <div class="news_bl">
                        {info}
						{content}
     
                <div class="clear"></div>

           </div>
           <!-- News Block -->
           
           [aviable=cat|main]
           <!-- Bottom Description -->
           <div class="bottom_des">
{banner_kat_info}
           </div>
           
           
           <!-- Bottom Description -->
           [/aviable]
           
    </div>
    <!-- Content Left Side -->
    
    <!-- Content Right Side -->
    <div class="cont_right_side">
    
          {include file="sidebar.tpl"}
       
    </div>
    <!-- Content Right Side -->
    
      <div class="clear"></div>
</div>

</div>
<!-- Main Content Block-->

[aviable=main]
<!-- Review -->
<div class="review_head">Мы находимся</div>

       <!-- Main Content Block SECONDARY -->
       <div class="main_colour_container allpage">
       
       <div class="main_content_block secondary">
           
             <!-- Map -->
             <div class="map_bl" id="ymaps-map" >
             </div>
<script type="text/javascript">
		function fid_134727447467949173209(ymaps) {
			var map = new ymaps.Map("ymaps-map", {
				center: [37.656424,55.705602], 
				zoom: 17, 
				type: "yandex#map"
			});

			map.controls
				.add("zoomControl")
				.add("mapTools")
				.add(new ymaps.control.TypeSelector(["yandex#map", "yandex#satellite", "yandex#hybrid", "yandex#publicMap"]));

			var placemark = new ymaps.Placemark([37.656424,55.705402], {}, {
			    iconImageHref: '{THEME}/img/map-marker.png',
                iconImageSize: [166, 101],
                iconImageOffset: [-84, -101],
                cursor: 'default'
			});
			map.geoObjects.add(placemark);
		};
	</script>
	<script type="text/javascript" src="http://api-maps.yandex.ru/2.0/?coordorder=longlat&load=package.full&wizard=constructor&lang=ru-RU&onload=fid_134727447467949173209"></script>
</section>
             <!-- Map -->
       </div>
       
       </div>
       <!-- Main Content Block SECONDARY -->
<!-- Review -->
[/aviable]

<!-- Footer Block -->
<div class="footer_bl">
    <div class="centri">
         <!-- Footer Menu -->
         <ul class="footer_menu">
             <li><a href="/">Каталог</a></li>
             <li><a href="/dostavka.html">Доставка и оплата</a></li>
             <li><a href="/otzyvy.html">Отзывы</a></li>
             <li><a href="/garantiya.html">Гарантия</a></li>
             <li><a href="/akcii.html">Акции</a></li>
             <li><a href="/about.html">О нас</a></li>
             <li><a href="/kontakty.html">Контакты</a></li>
         </ul>
         <!-- Footer Menu -->
         
       <!-- Footer Phones-->
         <div class="footer_phones">
             <span class="ourphone">+7 (800) 555 08 70</span>
             <span class="ourphone">+7 (495) &nbsp;215 &nbsp;58 70</span>
             <div class="workfootertime">Мы работаем <span>круглосуточно</span>
             <br />
             Без выходных
           </div>
         </div>
         <!-- Footer Phones-->
          <div class="clear"></div>
         <!-- Copyright -->
          <div class="coryright">
           <p>Copyright © 2010-2014 Фирменный магазин наушников Monster Beats</p>
           <p>OOO "Монст-битс" 0ГРH 1147847042155 Москва, ул. Автозаводская, 13/1</p>
          </div>
         <!-- Copyright -->
         

    </div>
</div>
<!-- Footer Block -->	


<!-- Callback -->
<div class="callback_wind"> <div class="callback_bag"></div>

<div class="b-popup callback">
	<div class="b-popup-inner">
		<div class="close-buttonthis"></div>
		<div class="main-title">
			Обратный звонок
			<span class="border"></span>
		</div>
		<div class="f-popup-form callback">
			<form action="/call.html#dle-content" method="post">
				<input type="hidden" name="form" value="callback">
				<input class="timezone" name="timezone" value type="hidden">
				<div class="f-element">
					<div class="f-control">
						<input class="input-list" name="name" type="text" placeholder="Имя" id="placeholder">
					</div>
				</div>
				<div class="f-element">
					<div class="f-control">
						<input class="input-list" name="phone" type="text" placeholder="Контактный телефон" id="placeholder">
					</div>
				</div>
				<div class="f-element-submit">
					<div class="f-control">
						<input class="submit-callback" type="submit" value="Заказать звонок">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

</div>
<!-- Callback -->



<!-- Get this now -->
<div class="bporder"> <div class="bporderbag"></div>


<div class="b-popup order">
	<div class="b-popup-inner">
		<div class="close-buttonthis"></div>
		<div class="main-title">
			Оформление заказа
			<span class="border"></span>
		</div>
		<div class="f-popup-form order">
			<form action="/zakaz.html#dle-content" method="post">
				<input type="hidden" name="form" value="order">
				<input class="id" name="id" value type="hidden">
				<input class="timezone" name="timezone" value type="hidden">
				<div class="order-info">
					<div class="item product_name">
						<span class="title">Заказ:</span>
                      
						<span class="description"></span>
						<input class="product_name" name="product_name" value type="hidden">
					</div>
					<div class="item price">
						<span class="title">Цена:</span>
						<span class="description"></span>
						<input class="price" name="price" value type="hidden">
					</div>
				</div>
				<div class="f-element">
					<div class="f-control">
						<input class="input-list transition" name="name" type="text" placeholder="Ф.И.О." id="placeholder">
					</div>
				</div>
				<div class="f-element">
					<div class="f-control">
						<input class="input-list transition" name="phone" type="text" placeholder="Контактный телефон" id="placeholder">
					</div>
				</div>
				<div class="f-element">
					<div class="f-control">
						<input class="input-list transition" name="adress" type="text" placeholder="Адрес доставки" id="placeholder">
					</div>
				</div>
				<div class="f-element textarea">
					<div class="f-control">
						<textarea class="transition" name="comment" placeholder="Комментарий к заказу" id="placeholder"></textarea>
					</div>
				</div>
				<div class="actions">
					<div class="f-element-submit">
						<div class="f-control">
							<input class="submit-callback" type="submit" value="Заказать">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


</div>
<!-- Get this now -->

</body>
</html>