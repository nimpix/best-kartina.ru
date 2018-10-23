$(function () {
	var term_phone = '8 (800) 500 16 69';
	var utms = parseUtm();
	if(Object.getOwnPropertyNames(utms).length){
		if(utms.utm_term ==="mkd"){
			$('.header-contacts .tel').text(term_phone);
			$('.footer-right .tel').text(term_phone);
		}
		var utm_order = JSON.stringify(utms);
		localStorage.setItem('utm_order', utm_order);
		$('.utm_order').val(utm_order);
	}else{
		var utm_order = localStorage.getItem('utm_order');
		if(utm_order){
			$('.utm_order').val(utm_order);
			utms = JSON.parse(utm_order);
			if(utms.utm_term ==="mkd"){
				$('.header-contacts .tel').text(term_phone);
				$('.footer-right .tel').text(term_phone);
			}
		}
	}
});


function parseUtm() {
	var tmp = {};
	var param = new Array() ;
	var items = location.search.substr(1).split("&");
	for (var index = 0; index < items.length; index++) {
	  param = items[index].split("="); 
	  if(param[0].split("_")[0]==="utm"){
		tmp[param[0]] = param[1];
	  }
	}
	return tmp;       
}











