<!doctype html>
<html lang="ru">
<head>

{headers}

<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="address=no">

<link rel="shortcut icon" href="{THEME}/favicon.ico" type="image/x-icon">
<link rel="icon" href="{THEME}/favicon.ico" type="image/x-icon">

<!-- Main site Js/css-->
<link rel="stylesheet" href="{THEME}/css/style.css">
<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic" rel="stylesheet"> 
<!-- Main site Js/css-->

<!--[if lt IE 9]>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
<![endif]-->

<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=MD82gTiN5G6iLt3R3ABwFuId71NFCIVImMKamcAzT7qY9RxJpqTSnuLBcfZy/quHixrEJZKaF2LKJ/xGgV4CIV4jxAssXcGtEoBV4y/oVN0M9jcxJK5t/DnA8oWpxsG9inRZWoaNg8Ho32Ommamk7LEiSsdgFw*ZX4fMixDJ7nk-&pixel_id=1000079528';</script>

</head>
{include file="engine/modules/pages_last.php"}

{AJAX}

<!-- Header Block -->
<header>
	<div class="header">
		<div class="wrap clearfix">
			<div class="header-logo">
				<a href="/">
					<img src="{THEME}/img/logo.png" alt="������ ��������� ������� � ��������">
				</a>
			</div>
			<div class="header-title">
				<h1>��������-������� ��������� ������<br>
				��� ������ ���������!</h1>
				<p>������� � �������� �������� � ���� ������ ����</p>
			</div>
			<div class="header-contacts">
				<a href="tel:88005550870" class="tel">8 (800) 555 08 70</a><br>
				<a href="" class="btn btn-call" onclick="yaCounter27000663.reachGoal('call_me'); ga('send', 'event', 'Lead', 'call_me', 'call_me'); return true;">����������� ���</a><br>
				<div class="open-time">�������� � 10:00 �� 22:00</div>
			</div>
		</div>
	</div>
	<!-- TopMenu -->
	[not-static=oplata,payment]
		{include file="topmenu.tpl"}	
	[/not-static]
	[static=oplata,payment]
		<div class="menu">
			<div class="wrap">
				<div class="menu-title">�������� ������</div>
			</div>
		</div>
	[/static]
	<!-- TopMenu -->
</header>

<!-- Header Block -->

<!-- ������ -->
[aviable=main|cat|tags|static|showfull]
[not-static=oplata,payment]
{banner_banner}
[/not-static]
[/aviable]

<!-- ������ -->

<!-- Main Content Block-->
<section id="content">
	<div class="wrap">
		[not-static=oplata,payment]
		<a href="" class="open-sidebar"><span>�������</span> �������</a>
		<div class="content_block clearfix">
			<aside class="left-column">
				{include file="sidebar.tpl"}
				<!-- ������ -->
				[banner_promo]
				<div class="banner-item">
				{banner_promo}
				</div>
				[/banner_promo]
				<!-- ������ -->
			</aside>
			<div class="content">
				{info}
				[aviable=main|cat]
				[not-category=52]
				<h1>������� ������ ��� �������� ������� ���������:</h1>
				[/not-category]
				[category=52]
				<h1>��� ������ ����� ������� � �������?<br>
				���� ������� ����� ������ � ��������!<br>
				��� ������� �����?</h1>
				[/category]
				[/aviable]

				[aviable=main|cat]
				<div class="catalog_block">
  					<div class="row">
						{content}
					</div>
				</div>
				[/aviable]

				[not-aviable=main|cat]
					<div class="main_block">
					{content}
					</div>
				[/not-aviable]
			</div>
		</div>
		[/not-static]
		[static=oplata]
			<div class="oplata_block">
				{info}
				{content}
			</div>
		[/static]
		[static=payment]
			{include file="payment.tpl"}
		[/static]
		[static=dostavka]
			{include file="delivery_more.tpl"}
		[/static]
	</div>
</section>

<!-- ����� -->

[static=pomosch-dizainera]
{include file="help_more.tpl"}
[/static]
[static=foto-na-holste]
{include file="print_more.tpl"}
[/static]

<!-- ����� -->

<!-- �� �������� -->

[aviable=main|cat]

<section id="viewed">
	<div class="wrap">
		<h2>�� ��������</h2>
		<div class="viewed_block owl-carousel">
			{include file="engine/modules/smotreli_last.php"}
		</div>
	</div>
</section>

[/aviable]

[not-aviable=main|cat]

<section id="viewed" class="hidden">
	<div class="wrap">
		<h2>�� ��������</h2>
		<div class="viewed_block owl-carousel">
			{include file="engine/modules/smotreli_last.php"}
		</div>
	</div>
</section>

[/not-aviable]

<!-- �� �������� -->

<!-- ������� ������ -->

[aviable=showfull]

<section id="viewed">
  <div class="wrap">
    <h2>������� ������</h2>
    <div class="viewed_block owl-carousel">
		{related-news}
    </div>
  </div>
</section>

[/aviable]

<!-- ������� ������ -->

<!-- ������ -->

[aviable=main|cat]

<section id="reviews">
	<div class="wrap">
		<h2>������ �����������</h2>
		<div class="rev_block">
			<div class="row">
				{include file="engine/modules/otzivi_last.php"}
			</div>
		</div>
		<div class="rev-btns clearfix">
			<a href="/review.html" class="btn btn-red">�������� �����</a>
			<a href="/otzyvy.html" class="btn btn-black">������ ���</a>
		</div>
	</div>
</section>

[/aviable]

<!-- ������ -->

<!-- ����� -->

[aviable=main]

<section id="info">
	<div class="wrap">
		{banner_kat_info}
	</div>
</section>

[/aviable]

[category=52]

<section id="info">
	<div class="wrap">
		{banner_kat_info}
	</div>
</section>

[/category]

<!-- ����� -->

<!-- Footer Block -->

<footer>
	<div class="wrap">
		<div class="footer_block clearfix">
			<div class="footer-left">
				<nav class="footer-menu">
					<ul>
						<li><a href="/">�������</a></li>
						<li><a href="/oplata.html">������</a></li>
						<li><a href="/dostavka.html">��������</a></li>
						<li><a href="/otzyvy.html">������</a></li>
						<li><a href="/garantiya.html">��������</a></li>
						<li><a href="/akcii.html">�����</a></li>
						<li><a href="/o-nas.html">� ���</a></li>
						<li><a href="/kontakty.html">��������</a></li>
					</ul>
				</nav>
				<div class="copyright">Copyright � 2010-2016 ��������� ������� ��������� ������</div>
			</div>
			<div class="footer-right">
				<a href="tel:88005550870" class="tel">8 (800) 555 08 70</a>
				<div class="open-time">�������� � <b>10:00</b> �� <b>22:00</b><br>
				��� ��������</div>
			</div>
		</div>
	</div>
</footer>

<!-- Footer Block -->

<!-- ������ -->

<div class="pop pop_up">
	<a href="" class="close-btn"></a>
	<div class="title">�������� ������</div>
	<p>� �� �������� � ���� � ��������� �����</p>
	<form class="form-send" novalidate>
		<div class="input">
			<input required type="text" name="name" placeholder="���� ���">
		</div>
		<div class="input">
			<input required type="tel" class="phone" name="phone" placeholder="��� �������">
		</div>
		<input type="hidden" name="ordername" value="����� ��������� ������">
		<input type="hidden" name="type" value="callback">
		<input class="timezone" name="timezone" value type="hidden">
		<input class="utm_order" name="utm" value type="hidden">
		<button type="submit">�������� ������</button>
	</form>
</div>

<div class="pop pop_promo">
	<a href="" class="close-btn"></a>
	<div class="title">����������� � ��������� ������ � ����� ������ � �������</div>
	<form class="form-send" novalidate>
		<div class="input">
			<input required type="text" name="name" placeholder="���� ���">
		</div>
		<div class="input">
			<input required type="text" class="email" name="email" placeholder="��� email">
		</div>
		<input type="hidden" name="ordername" value="��������� ������� �� �������">
		<input type="hidden" name="type" value="mail">
		<input class="timezone" name="timezone" value type="hidden">
		<input class="utm_order" name="utm" value type="hidden">
		<button type="submit">�����������</button>
	</form>
</div>

<div class="pop pop_order">
	<a href="" class="close-btn"></a>
	<div class="title">���������� ������</div>
	<form class="form-send" novalidate>
		<div class="order-info clearfix">
			<div class="order-img">
				<img src="{THEME}/img/dot.png" alt="">
			</div>
			<div class="order-text">
				<div class="order-title"></div>
				<p>���� ������ <span class="new_price"></span> <span style="color: #009963;">���.</span></p>
				<p>���� ����� <span class="old_price"></span></p>
			</div>
		</div>
		<div class="input">
			<input required type="text" name="name" placeholder="���� ���">
		</div>
		<div class="input">
			<input required type="tel" class="phone" name="phone" placeholder="��� �������">
		</div>
		<div class="input">
			<textarea rows="2" cols="30" name="adress" placeholder="����� ��������" style="height: 58px;"></textarea>
		</div>
		<input type="hidden" name="ordername" value="�����">
		<input type="hidden" class="hidden-id" name="id">
		<input type="hidden" class="hidden-price" name="price">
		<input type="hidden" class="hidden-name" name="product_name">
		<input type="hidden" class="tovar_img" name="tovar_img">
		<input type="hidden" class="card_options" name="card_options">
		<input type="hidden" name="type" value="order">
		<input class="timezone" name="timezone" value type="hidden">
		<input class="utm_order" name="utm" value type="hidden">
		<button type="submit">�������� �������</button>
		
	</form>
</div>
<div class="pop pop_success">
	<a href="" class="close-btn"></a>
	<div class="title">������� �� ������!</div>
	<p>�� �������� � ���� � ��������� �����</p>
</div>
<div id="overlay"></div>

<!-- ������ -->

<!-- ������� -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!--[if lt IE 10]>
<script src="js/placeholder.js"></script>
<![endif]-->
<script src="{THEME}/js/owl.carousel.min.js"></script>
<script src="{THEME}/js/jquery.maskedinput.min.js"></script>
<script src="{THEME}/js/magnific-popup.min.js"></script>
<script src="{THEME}/js/script.js"></script>
<script src="{THEME}/js/utm.js"></script>

<script type="text/javascript"> 
/* <![CDATA[ */
var google_conversion_id = 927235901; 
var google_custom_params = window.google_tag_params; 
var google_remarketing_only = true; 
/* ]]> */
</script> 
<noscript> 
<div style="display:inline;"> 
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/927235901/?value=0&amp;guid=ON&amp;script=0"/> 
</div> 
</noscript> 
<script type="text/javascript" src="{THEME}/js/FileAPI/config.js"></script>		
<script type="text/javascript" src="{THEME}/js/FileAPI/FileAPI.min.js"></script>
<script type="text/javascript" src="{THEME}/js/FileAPI/FileAPI.exif.js"></script>
<script type="text/javascript" src="{THEME}/js/FileAPI/jquery.fileapi.min.js"></script>
<script type="text/javascript" src="{THEME}/js/FileAPI/jcrop/jquery.Jcrop.min.js"></script>	
<script type="text/javascript" src="//consultsystems.ru/script/24826/" async charset="utf-8"></script>
<script src="https://entry.msite.top/saveutm.min.js"></script>

<!-- ������� -->

<script src="{THEME}/js/inputmask.js"></script>
<script src="{THEME}/js/inputmask.phone.extensions.js"></script>
<script src="{THEME}/js/jquery.inputmask.js"></script>

<!-- Timer-->
<link rel="stylesheet" href="{THEME}/timer/style.css">
<script type="text/javascript" src="{THEME}/timer/js/script.js"></script>
<script type="text/javascript" src="{THEME}/timer/js/jquery.cookie.js"></script>
<!-- Timer-->

<script type="text/javascript">
 $(document).ready(function(){
   $(".timezone").val(new Date().getTimezoneOffset());
 });
</script>

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

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '760132824136589', {
em: 'insert_email_variable,'
});
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=760132824136589&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

</body>
</html>