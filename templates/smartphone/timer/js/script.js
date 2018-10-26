(function( $ ) {
	var goods_time = [4, 8, 10, 20, 24, 28, 30, 45, 55, 59];
    var cur_animation = 0;
    var left_count_goods = 0;
    var old_lcd_value1 = 0;
    var old_lcd_value2 = 0;
    var old_lcd_value3 = 0;
    var old_lcd_value4 = 0;
	var old_lcd_value5 = 0;
    var old_lcd_value6 = 0;
    var curr_lcd_anim1 = 1;
    var curr_lcd_anim2 = 1;
    var curr_lcd_anim3 = 1;
    var curr_lcd_anim4 = 1;
    var catch_count_goods_1 = 0;
    var catch_count_goods_2 = 0;
    var catch_count_goods_3 = 0;
    var timer1 = 2;
    var timer2 = 2;
    var timer3 = 2;
    var timer4 = 2;
	var timer5 = 2;
    var timer6 = 2;
    var timer1_goods = true;
    var timer2_goods = true;
    var timer3_goods = true;
    var its_first = true;
	var curr_hour = 0;
    var curr_min = 0;
    var curr_sec = 0;
	var curr_time = 0;
//	var all_sec = 60*60+6*60+34;
	var all_sec = 23*60*60+15*60+24;
	var count_time_1 = 0;
	var count_time_2 = 0;
	var count_time_3 = 0;
	var count_time_4 = 0;
	var count_time_5 = 0;
	var count_time_6 = 0;
	
	function in_array(value, array){
        for(var i = 0; i < array.length; i++) 
        {
            if(array[i] == value) return true;
        }
        return false;
    }
	
    function in_array_time(times){
        var count_add_goods = 0;
        for(var i = 0; i < goods_time.length; i++) 
        {
            if(goods_time[i] <= times) count_add_goods = count_add_goods + 1;
        }
        return count_add_goods;
    }
	
	function getRandomInt(min, max){
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
	
	function left_count_goodsss(left_sec){
        var left_count_goodss = 1;
        for(var ia = 0; ia < goods_time.length; ia++) 
        {
            if(goods_time[ia] < left_sec){
                    left_count_goodss++;
            }
        }
        
        return left_count_goodss;
    }
	
	function setcountgoods(curr_time_goods){
		var curr_time_goods_s = curr_time_goods-Math.floor(curr_time_goods/60)*60;
		var curr_time_goods_m = Math.floor(curr_time_goods/60);
		
		var left_count_goods = curr_time_goods_m*10 + left_count_goodsss(curr_time_goods_s);
		
		if(cur_animation==1&&in_array(count_time_5*10+count_time_6,goods_time)){
			var time1 = new Date();
            var hours1 = time1.getHours();
            var min1 = time1.getMinutes();
			
			
			$('.trade-block ul.list li:eq(0)').animate({marginTop: "0"}, 500);
		}
		if(cur_animation==6&&in_array(count_time_5*10+count_time_6,goods_time)){
			$('.trade-block ul.list li').last().remove();
		}
		setLcdGoods(Math.floor(left_count_goods/100),Math.floor(Math.floor(left_count_goods-Math.floor(left_count_goods/100)*100)/10),left_count_goods-(Math.floor(left_count_goods/100)*100+Math.floor(Math.floor(left_count_goods-Math.floor(left_count_goods/100)*100)/10)*10),2,2,2);
	}
	
	function setrazvod(){
		if(its_first==true){
            var time = new Date();
            var hours = time.getHours();
            var min = time.getMinutes();
            var sec = time.getSeconds();
            its_first = false;
			
            
            if(typeof $.cookie('cookie_time') =="undefined"){
                $.cookie('cookie_time',time.getHours(),{expires: 1, path: '/'});
                $.cookie('cookie_min',time.getMinutes(),{expires: 1, path: '/'});
                $.cookie('cookie_sec',time.getSeconds(),{expires: 1, path: '/'});
				curr_time = all_sec;
            }else{
                var cookie_time = $.cookie('cookie_time');
                var cookie_min = $.cookie('cookie_min');
                var cookie_sec = $.cookie('cookie_sec');
                var oll_in_coocki_sec = Math.floor(cookie_sec)+(Math.floor(cookie_min*60))+((Math.floor(cookie_time)*60)*60);
                var oll_in_currenti_sec = sec+(min*60)+((hours*60)*60);

                if(Math.floor(oll_in_coocki_sec+all_sec)>oll_in_currenti_sec){
                    curr_time = Math.floor(oll_in_coocki_sec+all_sec - oll_in_currenti_sec);
					if (curr_time > all_sec) {
						$.cookie('cookie_time',time.getHours(),{expires: 1, path: '/'});
						$.cookie('cookie_min',time.getMinutes(),{expires: 1, path: '/'});
						$.cookie('cookie_sec',time.getSeconds(),{expires: 1, path: '/'});
						curr_time = all_sec;
					}
                }else{
                    $.cookie('cookie_time',time.getHours(),{expires: 1, path: '/'});
					$.cookie('cookie_min',time.getMinutes(),{expires: 1, path: '/'});
					$.cookie('cookie_sec',time.getSeconds(),{expires: 1, path: '/'});
					curr_time = all_sec;
                }
            }
			setcountgoods(curr_time);
        }
		if(cur_animation == 10){
            if(curr_time > 0){
                curr_time--;
            } else {
				var time = new Date();
				$.cookie('cookie_time',time.getHours(),{expires: 1, path: '/'});
				$.cookie('cookie_min',time.getMinutes(),{expires: 1, path: '/'});
				$.cookie('cookie_sec',time.getSeconds(),{expires: 1, path: '/'});
				curr_time = all_sec;
			}
            cur_animation = 0; 
        }

		if(cur_animation == 1){
			count_time_1 = Math.floor(((curr_time/60)/60)/10);
			count_time_2 = Math.floor((curr_time/60)/60)-count_time_1*10;
			count_time_3 = Math.floor((curr_time-(((count_time_1*10+count_time_2)*60)*60))/60/10);
			count_time_4 = Math.floor((curr_time-(((count_time_1*10+count_time_2)*60)*60))/60-count_time_3*10);
			count_time_5 = Math.floor((curr_time-((((count_time_1*10+count_time_2)*60)*60)+((count_time_3*10+count_time_4)*60)))/10);
			count_time_6 = Math.floor((curr_time-((((count_time_1*10+count_time_2)*60)*60)+((count_time_3*10+count_time_4)*60)))-count_time_5*10);
		}
		if(old_lcd_value1 == count_time_1){
            timer1 = 2;
        }else{
            timer1 = cur_animation-1;
        }
        if(old_lcd_value2 == count_time_2){
            timer2 = 2;
        }else{
            timer2 = cur_animation-1;
        }
        if(old_lcd_value3 == count_time_3){
            timer3 = 2;
        }else{
            timer3 = cur_animation-1;
        }
        if(old_lcd_value4 == count_time_4){
            timer4 = 2;
        }else{
            timer4 = cur_animation-1;
        }
		if(old_lcd_value5 == count_time_5){
            timer5 = 2;
        }else{
            timer5 = cur_animation-1;
        }
        if(old_lcd_value6 == count_time_6){
            timer6 = 2;
        }else{
            timer6 = cur_animation-1;
        }
		if(cur_animation<4){
			setLcd(count_time_1,count_time_2,count_time_3,count_time_4,count_time_5,count_time_6,timer1,timer2,timer3,timer4,timer5,timer6);
		}
		
		if(cur_animation>4){
            old_lcd_value1 = count_time_1;
            old_lcd_value2 = count_time_2;
            old_lcd_value3 = count_time_3;
            old_lcd_value4 = count_time_4;
			old_lcd_value5 = count_time_5;
            old_lcd_value6 = count_time_6;
        }
		if(in_array(count_time_5*10+count_time_6,goods_time)){
			setcountgoods(curr_time);
		}
		cur_animation++;
	}
	
	function setLcd(lcd1,lcd2,lcd3,lcd4,lcd5,lcd6,timer1,timer2,timer3,timer4,timer5,timer6){
        $('.count_time_1 img').attr('src', '/templates/BestKartina/timer/images/flipper'+lcd1+timer1+'.png');
		$('.count_time_2 img').attr('src', '/templates/BestKartina/timer/images/flipper'+lcd2+timer2+'.png'); 
		$('.count_time_3 img').attr('src', '/templates/BestKartina/timer/images/flipper'+lcd3+timer3+'.png');
		$('.count_time_4 img').attr('src', '/templates/BestKartina/timer/images/flipper'+lcd4+timer4+'.png');
		$('.count_time_5 img').attr('src', '/templates/BestKartina/timer/images/flipper'+lcd5+timer5+'.png'); 
		$('.count_time_6 img').attr('src', '/templates/BestKartina/timer/images/flipper'+lcd6+timer6+'.png');		
    }
	
    function setLcdGoods(lcd1,lcd2,lcd3,timer1,timer2,timer3){
		$('.count_goods_100 img').attr('src', '/templates/BestKartina/timer/images/flipper'+lcd1+timer1+'.png');
		$('.count_goods_10 img').attr('src', '/templates/BestKartina/timer/images/flipper'+lcd2+timer2+'.png'); 
		$('.count_goods_1 img').attr('src', '/templates/BestKartina/timer/images/flipper'+lcd3+timer3+'.png');
    }
	
	$(document).ready(function() {
		setInterval(setrazvod, 100);

		if($('.oll_count').html()>0){
			$('.cart_top').html('Товаров - '+$('.oll_count').html()+', Стоимость - '+$('.oll_price').html()+' руб.');
		}else{
			$('.cart_top').html('Корзина пуста');
			$('.user_bu').css('display','none');
		}
		$('.shk-but').on('click',function(){
			SHK.fillCart($(this).parent());
			SHK.refreshCart();
			$(".lightbox").trigger('click');
			return false;
		});
		$('.product-item .heading').on('click',function(){
			window.location.href = $(this).parent('.product-item').find('a.btn-1').attr('href');
		});
		$('.product-item .visual img').on('click',function(){
			window.location.href = $(this).parents('.product-item').find('a.btn-1').attr('href');
		});
    });
})(jQuery);
function SHKloadCartCallback(){
	if(SHK.data.items_total>0){
		jQuery('.cart_top').html('Товаров - '+SHK.data.items_total+', Стоимость - '+SHK.data.price_total+' руб.');
		jQuery('.user_bu').css('display','block');
	}else{
		jQuery('.cart_top').html('Корзина пуста');
		jQuery('.user_bu').css('display','none');
	}
}