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
			$(window).load(function(){
			
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58376919-1', 'auto');
  ga('send', 'pageview');

</script>

{AJAX}

<!-- Header Block -->
<div class="header_bl"> 
       <div class="centri">
	        <div class="logo_bl">
            <a href="/" class="logo"><img src="{THEME}/img/logo.png" alt="Купите модульные картины в интерьер" /></a>
	        </div>

	         <div class="header_cont">
                 <ul class="header_phones">
                     <li><span class="city">Москва</span><span class="mobile">+7 (495) 215 58 70</span></li>
                     <li class="secondary"><span class="city">Россия (звонок бесплатный!)</span><span class="mobile">+7 (800) 555 08 70</span></li>
                 </ul>
             <div class="clear"></div>
                 <div class="worktime">Мы работаем с 9 до 22 часов и без выходных</div>
                 
                   <div class="callback_bl">
                       <div class="callback_arrow"></div>
                       <a class="callback_button other" onclick="yaCounter27000663.reachGoal('call_me'); return true;">Перезвоните мне</a>
                   
                   </div>
	         </div>

              <div class="clear"></div>
       </div>
</div>
<!-- Header Block -->

<!-- TopMenu -->
{include file="topmenu.tpl"}
<!-- TopMenu -->




<!-- Special Block -->
<div class="special_bl" id="akcii">
     <div class="centri special_width">
          
          <div class="speci1">
               <p class="stext1" style="min-width: 187px;">Быстрая Доставка</p>
               <p class="stext4"><span>по России от 3х дней</span>
               </p>
               <p class="stext4" style="min-width: 175px;">Мы оплатим вам часть<br /> стоимости доставки
               <br />
               <a href="/dostavka.html" class="stext_link red" onsubmit="yaCounter27000663.reachGoal('hochu'); return true;">Подробнее!</a></p>
               <br /><br />
               <p class="stext3"><span>Оплата при получении</span></p>
               <p class="stext4">Посмотрите картину<br /> перед оплатой!
               <br />
                <a href="/dostavka.html" class="stext_link" onsubmit="yaCounter27000663.reachGoal('poprobovat'); return true;">Заказать</a>
               </p>
               
               
               <div class="speci_map"></div>
          </div>
          
          <div class="speci2"> <div class="speci_gift"></div>
          
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
                  <li>Скидки до 40%</li>
                  <li>Выгодная доставка</li>
                  <li>MP3 плеер в подарок</li>
               </ul>
          </div>
          


          <div class="speci1">
               <p class="stext1" style="min-width: 187px;">Печать на</p>
               <p class="stext4"><span>натуральном хосте</span>
               </p>
               <p class="stext4" style="min-width: 175px;">Немецкое производство<br />плотность 390 г/м2</p>
               <br />
               <p class="stext3"><span>Обработка текстурным гелем</span></p>
               <p class="stext4">для имитации живописи</p>
               <br />
               
               <p class="stext2">Бесплатная помощь<br /> дизайнера в подборе картины!
               <br />
               <a href="/pomosch-dizainera.html" class="stext_link red" onsubmit="yaCounter27000663.reachGoal('besplatno'); return true;">Заказать!</a>
               </p>

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
             <li><a href="/o-nas.html">О нас</a></li>
             <li><a href="/kontakty.html">Контакты</a></li>
         </ul>
         <!-- Footer Menu -->
         
       <!-- Footer Phones-->
         <div class="footer_phones">
             <span class="ourphone">+7 (800) 555 08 70</span>
             <span class="ourphone">+7 (495) &nbsp;215 &nbsp;58 70</span>
             <div class="workfootertime">Мы работаем <span>с 9 до 22 часов</span>
             <br />
             Без выходных
           </div>
         </div>
         <!-- Footer Phones-->
          <div class="clear"></div>
         <!-- Copyright -->
          <div class="coryright">
           <p>Copyright © 2010-2014 Фирменный магазин Модульных Картин</p>
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
				<div class="order-info">
					<div class="item product_name">
						<span class="title">Внимательно проверьте номер, иначе мы не сможем вам дозвониться для оформления заказа</span>
					</div>
				</div>
				<div class="f-element">
					<div class="f-control">
						<input class="input-list transition" name="email" type="text" placeholder="E-mail" id="placeholder">
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

<script type="text/javascript" src="http://consultsystems.ru/script/24826/" charset="utf-8"></script>

</body>
</html>