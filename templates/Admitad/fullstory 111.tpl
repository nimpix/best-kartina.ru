<script type="text/javascript">
    $(window).load(function() {
        yaCounter27000663.reachGoal('tovar_page');
		
		var selector = '.psa-options';      // ������� �������� ���� � �������
		var selector2 = '.psa-options2';	// ������� ������� ������������ �� 1 ����
		var selector3 = '.psa-options3';	// ������� �����
		var selector4 = '.psa-options4';	// ������� ������ ��� ���������
		
		// ����������� ������ ���� psa_order � ��������� ����� 
		// ��� ������ ����� �����-������ ���������� ��������� � ����� div psa_order 
		$('.radio-item').change(function () {
			$(".psa_order").empty();
			$(".new_price.psa_p span").clone().appendTo(".psa_order");
			var $total_order = $('.psa_order').text();
			
			var $new_price = parseInt($(".psa_order").text());
			
			if($(selector).hasClass('selected')){
			$new_price += $(selector).data('value');
			$(".psa_order").text($new_price);
			}
			
			if($(selector2).hasClass('selected2')){
			$new_price += $(selector2).data('value');
			$(".psa_order").text($new_price);
			}
			
			if($(selector3).hasClass('selected3')){
			oilCost = parseInt($(selector3).attr('data-value'));
			$new_price += oilCost;
			$(".psa_order").text($new_price);
			}

			
		 });
		
		// �������������� ����� selected, selected2, selected3 ��� ���������� ��������
		$(selector).on('click', function(){		
			if($(selector).hasClass('selected')){
			   $(selector).removeClass('selected');
			//	$('.goods-img.gallery .img a img').attr('src', '/img/img.php?h=310&w=471&src={image-1}');
			}else{
				$(selector).removeClass('selected');
				$(this).addClass('selected');
			//	$('.goods-img.gallery .img a img').attr('src', '/uploads/chasy/m3.jpg');
			}
		});
		
		$(selector2).on('click', function(){		
		if($(selector2).hasClass('selected2')){
		   $(selector2).removeClass('selected2');
		}else{
			$(selector2).removeClass('selected2');
			$(this).addClass('selected2');
		}
		});

		$(selector4).on('click', function(){		
		if($(selector4).hasClass('selected4')){
		   $(selector4).removeClass('selected4');
		}else{
			$(selector4).removeClass('selected4');
			$(this).addClass('selected4');
		}
		});
		
		$('.psa-options3').on('click', function(){
			new_price = parseInt($(".psa_order").text());
			lastOfvalue = 0;
			switch ($('[type="radio"]:checked').attr('id')){
				case 'radio_m':
					lastOfvalue = 4000;
				break;
				case 'radio_l':
					lastOfvalue = 5000;
				break;
				case 'radio_xl':
					lastOfvalue = 6000;
				break;
			}			
			if($(this).hasClass('selected3')){
			   $(this).removeClass('selected3');			   
			   new_price -= lastOfvalue;
			}else{			
				$(this).addClass('selected3');			
				new_price += lastOfvalue;
			}
		$(".psa_order").text(new_price);
		});
		
		// ������ ��������� ���� ���������� ���������� �� ���������
		//
		// ������� �������� ���� � �������
		$(selector).change(function() {
		var $new_price = parseInt($(".psa_order").text());
		if($(this).hasClass('selected')){
			$new_price += $(this).data('value');
			}
			else {
			$new_price -= $(this).data('value');
			}
			$(".psa_order").text($new_price);
		});
		
		// ������� ������� ������������ �� 1 ����
		$(selector2).change(function() {
		var $new_price = parseInt($(".psa_order").text());
		if($(this).hasClass('selected2')){
			$new_price += $(this).data('value');
			}
			else {
			$new_price -= $(this).data('value');
			}
			$(".psa_order").text($new_price);
		});
		
		$('#radio_m').on('click', function() {
		$('.psa-options3').attr('data-value', '4000');
		$('.psa-options3').attr('value', '�������� ��� ������� ������ - m');
		}); 

		$('#radio_l').on('click', function() {
		$('.psa-options3').attr('data-value', '5000');
		$('.psa-options3').attr('value', '�������� ��� ������� ������ - la');
		});
		
		$('#radio_xl').on('click', function() {
		$('.psa-options3').attr('data-value', '6000');
		$('.psa-options3').attr('value', '�������� ��� ������� ������ - xxl');
		});

    });
</script>


<!-- FULL news-->
<div class="goods">
	<h1>{title}[catlist=21] (������ ���������)[/catlist]</h1>
	<div class="goods-item clearfix">
		<div class="goods-img gallery">
			<div class="img">
				<a href="{image-1}" title="������� {title}[catlist=21] (������ ���������)[/catlist]">
					<img alt="{title}" title="{title}" src="/img/img.php?h=310&amp;w=471&amp;src={image-1}">
				</a>
			</div>
			<div class="goods-price">
				<div class="psa-pricer">����� ����: <div class="psa_order">[xfvalue_cena_m]</div> ���. </div>
				<div class="new_price psa_p" style="display:none;">����� ����: <span>[xfvalue_cena_m]</span> ���.</div>
				[xfgiven_cena_m_old]
				<div class="old_price">������ ����: <span>[xfvalue_cena_m_old]</span> ���.</div>
				[/xfgiven_cena_m_old]
			</div>
		</div>
		<div class="goods-info">
			<div class="radio_btns">
				[xfgiven_cena_m]
				<div class="radio-item radio_m" data-value="[xfvalue_cena_m]" data-old="[xfvalue_cena_m_old]" data-razmer="[xfvalue_razmer_m]">
					<input type="radio" id="radio_m" name="size" checked>
					<label for="radio_m">
						[xfgiven_razmer_m]
						[xfvalue_razmer_m] �� [xfgiven_gotov_m]<span class="send_soon">(�������� ��� ������)</span>[/xfgiven_gotov_m]
						[/xfgiven_razmer_m]
						[xfnotgiven_razmer_m]������ �� ������[/xfnotgiven_razmer_m]
					</label>
				</div>
				[/xfgiven_cena_m]
				[xfgiven_cena_l]
				<div class="radio-item radio_l" data-value="[xfvalue_cena_l]" data-old="[xfvalue_cena_l_old]" data-razmer="[xfvalue_razmer_l]">
					<input type="radio" id="radio_l" name="size">
					<label for="radio_l">
						[xfgiven_razmer_l]
						[xfvalue_razmer_l] �� [xfgiven_gotov_l]<span class="send_soon">(�������� ��� ������)</span>[/xfgiven_gotov_l]
						[/xfgiven_razmer_l]
						[xfnotgiven_razmer_l]������ �� ������[/xfnotgiven_razmer_l]
					</label>
				</div>
				[/xfgiven_cena_l]
				[xfgiven_cena_xl]
				<div class="radio-item radio_xl" data-value="[xfvalue_cena_xl]" data-old="[xfvalue_cena_xl_old]" data-razmer="[xfvalue_razmer_xl]">
					<input type="radio" id="radio_xl" name="size">
					<label for="radio_xl">
						[xfgiven_razmer_xl]
						[xfvalue_razmer_xl] �� [xfgiven_gotov_xl]<span class="send_soon">(�������� ��� ������)</span>[/xfgiven_gotov_xl]
						[/xfgiven_razmer_xl]
						[xfnotgiven_razmer_xl]������ �� ������[/xfnotgiven_razmer_xl]
					</label>
				</div>
				[/xfgiven_cena_xl]				
			</div>
			<div class="checkbox_btns">
				<div class="checkbox-item">
					<input type="checkbox" id="option-1" class="options psa-options" name="options" value="�������� ���� � �������" data-value="900">
					<label for="option-1">�������� ���� � �������</label>
				</div>
				[xfgiven_maslo]		
				<div class="checkbox-item psa-maslo1">
					<input type="checkbox" id="option-2" class="options psa-options3" name="options" value="�������� ��� ������� ������ - m"  data-value="">
					<label for="option-2">�������� ��� ������� ������</label>
				</div>
				[/xfgiven_maslo]		
				<div class="checkbox-item">
					<input type="checkbox" id="option-3" class="options psa-options2" name="options" value="������� ������������ �� 1 ����" data-value="300">
					<label for="option-3">������� ������������ �� 1 ����</label>
				</div>
					<div class="checkbox-item">
					<input type="checkbox" id="option-4" class="options psa-options4" name="options" value="������ ��� ���������" data-value="">
					<label for="option-4">������ ��� ���������</label>
				</div>
			</div>
			<div class="goods-price">
				<input type="hidden" class="hidden-size" name="size" value="[xfvalue_razmer_m] ��">
				<input type="hidden" class="hidden-id" name="id" value="{news-id}">
				<a href="" class="btn btn-buy" onclick="yaCounter27000663.reachGoal('order_form'); return true;">������</a>
			</div>
		</div>
	</div>
	[xfgiven_art_interior]
	<div class="goods-carousel owl-carousel gallery">
		<div class="img">
			<a href="/uploads/preim.jpg" title="������� {title}">
				<img src="/img/img.php?h=138&amp;w=213&amp;src=/uploads/preim.jpg"/>
			</a>
		</div>

	<?
if (file_exists("uploads/chasy/[xfvalue_art_interior].jpg")) { // ��� ����� � ������
echo <<<HTML
		<div class="img">
			<a href="/uploads/chasy/[xfvalue_art_interior].jpg" title="������� {title}">
				<img src="/img/img.php?h=138&amp;w=213&amp;src=/uploads/chasy/[xfvalue_art_interior].jpg">
			</a>
		</div>
HTML;
}
	?>

		<div class="img">
			<a href="/uploads/interior/1/[xfvalue_art_interior]_interior_1.jpg" title="������� {title}">
				<img src="/img/img.php?h=138&amp;w=213&amp;src=/uploads/interior/1/[xfvalue_art_interior]_interior_1.jpg">
			</a>
		</div>
		<div class="img">
			<a href="/uploads/interior/2/[xfvalue_art_interior]_interior_2.jpg" title="������� {title}">
				<img src="/img/img.php?h=138&amp;w=213&amp;src=/uploads/interior/2/[xfvalue_art_interior]_interior_2.jpg" >
			</a>
		</div>
		<div class="img">
			<a href="/uploads/interior/3/[xfvalue_art_interior]_interior_3.jpg" title="������� {title}">
				<img src="/img/img.php?h=138&amp;w=213&amp;src=/uploads/interior/3/[xfvalue_art_interior]_interior_3.jpg" >
			</a>
		</div>
		<div class="img">
			<a href="/uploads/interior/4/[xfvalue_art_interior]_interior_4.jpg" title="������� {title}">
				<img src="/img/img.php?h=138&amp;w=213&amp;src=/uploads/interior/4/[xfvalue_art_interior]_interior_4.jpg">
			</a>
		</div>
	</div>
	[/xfgiven_art_interior]
	<div class="btns clearfix">
		<a href="" class="btn btn-more">��������</a>
		<a href="" class="btn btn-descr" id="delivery-popup">������� ��������</a>
	</div>
	<div class="goods-about">
		[catlist=20]
		<p style="color:#3366FF">������ ��������� �������!</p>
		<p>�������� �������� (����� ������ ��� �������� ��������� ������� ����������� ���������� �����, �������� �����)</p>
      [/catlist]
      {full-story}
	</div>
</div>