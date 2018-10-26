$(document).ready(function () {
	// console.log("script.js");
  // Маска для телефона
  // $('.phone').mask("+9 (999) 999-9999");
  
  $(".phone").inputmask({"mask": "+9 (999) 999-9999"});

  // Всплывающее окно
  function pop(pop_name) {
    var top = $(window).scrollTop() + 60;
    $(pop_name).css({'top' : top,'position' : 'absolute'});
    $('#overlay,' + pop_name).addClass('fadeIn');
  }
  $('.btn-call, .call-link').on('click', function(e) {
    e.preventDefault();
    pop('.pop_up');
  });
  $('.btn-promo').on('click', function(e) {
    e.preventDefault();
    pop('.pop_promo');
  });
  
  $('.btn-order, .btn-buy').on('click', function(e) {
    e.preventDefault();
    var $parent = $(this).parent().parent();
    if ($(this).hasClass('btn-buy')) {
      var $img = $parent.prev().find('img').attr('src');
      var $title = $(this).parents('.goods').children('h1').text();
      var $new_price = $parent.prev().find('.psa_order').text();
      var $old_price = $parent.prev().find('.old_price span').text();
	  
      var $val = '';
      $parent.find('.options').each(function() {
        if ($(this).prop('checked')) {
          if ($val == '') {
            $val = $(this).val();
          } else {
            $val = $val + ', ' + $(this).val();
          }
        }
      });
      $('.pop_order').find('.new_price').text($new_price);
      $('.pop_order').find('.card_options').val($val);
    } else {
      var $img = $parent.find('.cat-img img').attr('src');
      var $title = $parent.find('h3').text();
      var $new_price = $parent.find('.new_price span').text();
      var $old_price = $parent.find('.old_price span').text();
      $('.pop_order').find('.new_price').text($new_price + 'РУБ.');
    }
    var $id = $parent.find('.hidden-id').val();
    var $size = $parent.find('.hidden-size').val();
	
    $('.pop_order').find('.order-img img').attr('src', $img);
    $('.pop_order').find('.order-title').text($title);
    $('.pop_order').find('.old_price').text($old_price + ' РУБ.');
    $('.pop_order').find('.hidden-id').val($id);
    $('.pop_order').find('.hidden-price').val($new_price);
    $('.pop_order').find('.tovar_img').val('http' + $img.split('http')[1]);
    if (!!$size) {
      $('.pop_order').find('.hidden-name').val($title + ' ' + $size);
    } else {
      $('.pop_order').find('.hidden-name').val($title);
    }
    pop('.pop_order');
  });
  $('.goods .btn-more').on('click', function(e) {
    e.preventDefault();
    if (!$(this).hasClass('active')) {
      $(this).addClass('active');
      $(this).parent().next('.goods-about').slideDown(300);
    } else {
      $(this).removeClass('active');
      $(this).parent().next('.goods-about').slideUp(300);
    }
  });
  $('.close-btn, #overlay').on('click', function(e) {
    e.preventDefault();
    $('#overlay, .pop').removeClass('fadeIn');
  });

  // Плавающее меню
  $(window).scroll(function(){
    var top = $(this).scrollTop();
    var h_height = $('.header').outerHeight(); 
    var elem = $('.menu');
    if (top > h_height) {
     elem.addClass('fixed');
    } else {
     elem.removeClass('fixed');
    }
  });

  // Мобильное меню
  $('.open-menu').on('click', function(e) {
    e.preventDefault();
    if (!$(this).hasClass('active')) {
      $(this).addClass('active');
      $(this).next().addClass('active');
    } else {
      $(this).removeClass('active');
      $(this).next().removeClass('active');
    }
  });

  // Сайдбар
  $('.open-sidebar').on('click', function(e) {

    e.preventDefault();

    if (!$(this).hasClass('active')) {
      $(this).addClass('active');
      $(this).next().addClass('active');
      $(this).children('span').text('Закрыть');
    } else {
      $(this).removeClass('active');
      $(this).next().removeClass('active');
      $(this).children('span').text('Открыть');
    }

  });

  // Радио кнопки
  $('.radio-item').on('click', function() {
    var $old_price = $(this).data('old');
    var $new_price = $(this).data('value');
    var $size = $(this).data('razmer');
    $(this).parents('.goods-item').find('.new_price span').text($new_price);
    $(this).parents('.goods-item').find('.old_price span').text($old_price);
    $(this).parents('.goods-item').find('.hidden-size').val($size);
  });
  
    // Чек кнопки
/*    $('.psa-options').change(function() {
    var $new_price = $(this).data('old');
    $new_price += $(this).data('value');
    $(this).parents('.goods-item').find('.new_price span').text($new_price);
  }); */

  // Прикрепить файл
    $(".uploaded_file").on('change', function () {

      if ($(this).attr('required')) {
        $(this).parent().removeClass('error');
        $(this).addClass('not_error');
      }
      var size = (this.files[0].size/1024).toFixed(2);
      if (size > 30000) {
        alert('Размер файла не должен быть больше 30мб');
      } else {
        realVal = $(this).val();
        lastIndex = realVal.lastIndexOf('\\') + 1;
        if(lastIndex !== -1) {
           realVal = realVal.substr(lastIndex);
           $(this).parent().find('span').html(realVal);
        }
      }
 
    });

    // Карусель

    var $carousel = $(".viewed_block");
    var $carousel2 = $(".goods-carousel");
    if ($carousel.hasClass('owl-carousel')) {

      $carousel.owlCarousel({

        nav: true,
        navText: ['',''],
        smartSpeed: 500,
        margin: 30,
        dots: false,
        rewind: true,
        responsive:{
            0: {
                items:1
            },
            480: {
                items:2
            },
            768: {
                items:3
            },
            960: {
                items:4
            }
        }

      });
      
    }

    if ($carousel2.hasClass('owl-carousel')) {

      $carousel2.owlCarousel({

        nav: true,
        navText: ['',''],
        smartSpeed: 500,
        margin: 30,
        dots: true,
        rewind: true,
        responsive:{
            0: {
                items:2
            },
            600: {
                items:3
            }
        }

      });
      
    }

   // Слайдер

   $(".detail-slider").owlCarousel({

    items: 1,
    nav: true,
    navText: ['',''],
    autoplay: true,
    autoplayTimeout: 10000,
    autoplayHoverPause: true,
    rewind: true,
    smartSpeed: 500

    });

  // Увеличение фото
/*       $('.gallery').each(function() {
          $(this).magnificPopup({
            type:'image',
            delegate: 'a',
            tLoading: 'Загрузка...',
            removalDelay: 300,
            closeOnContentClick: true,
            mainClass: 'mfp-zoom-in mfp-img-mobile',
            gallery: {
                  enabled: true,
                  tPrev: 'Предыдущая',
                  tNext: 'Следующая',
                  tCounter: '<span class="mfp-counter">%curr% из %total%</span>'
                },
              callbacks: {

            imageLoadComplete: function() {
              var self = this;
              setTimeout(function() {
                self.wrap.addClass('mfp-image-loaded');
              }, 16);
            },
            close: function() {
              this.wrap.removeClass('mfp-image-loaded');
            }
          },
         closeMarkup: '<a href="javascript:void(0);" class="mfp-close" title="Закрыть">x</a>'
      });
      }); */
	  
	$('.gallery').magnificPopup({
		type:'image',
		delegate: 'a',
		tLoading: 'Загрузка...',
		removalDelay: 300,
		closeOnContentClick: true,
		mainClass: 'mfp-zoom-in mfp-img-mobile',
		gallery: {
			  enabled: true,
			  tPrev: 'Предыдущая',
			  tNext: 'Следующая',
			  tCounter: '<span class="mfp-counter">%curr% из %total%</span>'
			},
		  callbacks: {

		imageLoadComplete: function() {
		  var self = this;
		  setTimeout(function() {
			self.wrap.addClass('mfp-image-loaded');
		  }, 16);
		},
		close: function() {
		  this.wrap.removeClass('mfp-image-loaded');
		}
	  },
	 closeMarkup: '<a href="javascript:void(0);" class="mfp-close" title="Закрыть">x</a>'
  });

  // Обработчик формы
     $('input').blur( function() {

         var id = $(this).attr('name');
         var val = $(this).val();
         if ($(this).attr('required')) {
          if(val.length > 2 && val != '')
            {
               $(this).removeClass('error');
               $(this).addClass('not_error');
            }
            else
            {
               $(this).removeClass('not_error');
               $(this).addClass('error');
            }
         switch(id)
         {

              // Проверка email
                 case 'email':
                     var rv_mail = /.+@.+\..+/i;
                     if(val != '' && val != 'Введите e-mail' && rv_mail.test(val))
                     {
                        $(this).removeClass('error');
                         $(this).addClass('not_error');

                     }
                     else
                     {
                  $(this).removeClass('not_error');
                   $(this).addClass('error');

                     }
                 break;

         }
        }

     });

    // Теперь отправим наше письмо с помощью AJAX
     $('form.form-send').submit(function(e){

         e.preventDefault();

         var formData = new FormData($(this)[0]);

         $(this).find('input').each(function(){
          if ($(this).attr('required')) {
            $(this).addClass('require');
          }
        });
        var count = $(this).find('.require').length;

         if($(this).find('.not_error').length >= count)
         {

             $.ajax({
                    url: '/engine/ajax/send.php',
                    type: 'post',
                    context: this,
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,


                    beforeSend: function(xhr, textStatus){
                         $(this).find('input').not(':hidden').attr('disabled','disabled');
                    },

                   success: function(response){
                        console.log(response);
var data = JSON.parse(response);
console.log(data);
                        $('input').removeAttr('disabled');
                        $(this).find('input').not(':hidden').val('').removeClass('error not_error');
                        $('#overlay, .pop').removeClass('fadeIn');
                        pop('.pop_success');
                        if(data.result.type == 'order'){
                              yaCounter27000663.reachGoal('order_send');
                              fbq("track", "Lead");
console.log("Заказ отправлен");                          
                         }
                         if(data.result.type == 'callback'){
                           yaCounter27000663.reachGoal('order_call');
                           fbq("track", "Lead");
console.log("Колбэк отправлен");        
                           }

                   }
            });
        }
        else
        {
          $(this).find('input').each(function(){
            if($(this).hasClass('require') && !$(this).hasClass('not_error')) {
            $(this).addClass('error');
          }
          });
          return false;
        }
        return false;
   });

});