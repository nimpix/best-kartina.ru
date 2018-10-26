$(function () {

/* all last */
if($(".pagination_bl").length>0) {
  $('div.one_news:nth-child(3n+2)').css( "margin-right", "0px" );
} else { $('div.one_news:nth-child(3n)').css( "margin-right", "0px" ); }
 $('div.review_one:nth-child(3n)').css( "border-right", "none" );
 $('.colours_pack a:nth-child(6n)').css( "margin-right", "0%" );
 $('ul.footer_menu li').last().css( "margin-right", "0%" );
 
/* all last */


/* CallBack*/

 $( "a.callback_button" ).click(function() {
   $(".callback_wind").fadeIn("slow");
   $(".timezone").val(new Date().getTimezoneOffset());
});


 $( ".callback_bag,.close-buttonthis" ).click(function() {
   $(".callback_wind").fadeOut("slow");
});

/* CallBack*/


/*fullnews viewing */
$( ".sliderkit-panel a" ).click(function() {
	
   $(".sliderkit_view").fadeIn("slow"); 
   jQuery("div.img_leftside div#full-gallery").attr("id","newId");
  
});


$( "div.img_leftside div a" ).click(function() {
	
   $(".sliderkit_view").fadeIn("slow"); 
   jQuery("div.right_side_imgs div#full-gallery").attr("id","newId");
  
});
/*fullnews viewing */



/* Order FullPage POPUP */

 $( "a.full_buy" ).click(function() {
   $(".bporder").fadeIn("slow");
   
$("div.item.product_name span.description").empty();
$("div.item.price span.description").empty();

$("div.item.product_name span.description").append($("div.full_news h1").text());
$("div.item.price span.description").append($("div.full_prise_cost").text());

$("div.item.product_name input.product_name").val($("div.full_news h1").text());
$("div.item.price input.price").val($("div.full_prise_cost span").text());
$("input.id").val($("div.full_price span.id").text());
$("input.tovar_img").val($("div.full_price span.tovar_img").text());

   $(".timezone").val(new Date().getTimezoneOffset());
   
});


 $( ".close-buttonthis,.bporderbag" ).click(function() {
   $(".bporder").fadeOut("slow");
   
/* of zakaz */
$("div.one_news.active").removeClass('active');
/* of zakaz */

});



/* Order FullPage POPUP */



/********** Order MAINPAGE ***************/ 

$("a.wantnow").on('click', function(){

$(".bporder").fadeIn("slow");
   
$("div.item.product_name span.description").empty();
$("div.item.price span.description").empty();

    $(this).parent("div").addClass('active');
	$("div.item.product_name span.description").append($("div.one_news.active div.one_news_cont h3 a").text());
	$("div.item.price span.description").append($("div.one_news.active div.one_news_cont div.new_price div.short_np_cost").text());

$("div.item.product_name input.product_name").val($("div.one_news.active div.one_news_cont h3 a").text());
$("div.item.price input.price").val($("div.one_news.active div.one_news_cont div.new_price div.short_np_cost span").text());
$("input.id").val($("div.one_news.active span.id").text());
$("input.tovar_img").val($("div.one_news.active span.tovar_img").text());

   $(".timezone").val(new Date().getTimezoneOffset());
	
});

/********** Order MAINPAGE ***************/





});
