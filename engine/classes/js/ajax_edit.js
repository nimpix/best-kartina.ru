$(document).ready(function(){
	var rapture = function (which) {
		$(which).contents().filter(function() {
			return this.nodeType === 3;
		})
//		.wrap('<p></p>')
		.end()
			.filter('br')
	 			.remove()
			.end()
				.end()
				.children().filter(function() {
					$(this).html($.trim($(this).html().replace(/(\t|\n)/g,"")));

					return !$(this).text().length
				}).remove();
	}

	$('.editable, .editable-area')
		.hover(function() {
			$(this).toggleClass('over-inline');
		})
		.dblclick(function(event) {// start the inline editing
			var $editable = $(this);
			if($editable.hasClass('active-inline')) {
				return;
			}

var editHeight = $(this).height()+5;
var editWidth = $(this).width()+20;
if($editable.hasClass('editable') == false) editHeight = editHeight+20;

			var contents = $.trim($editable.html().replace(/\/p>/g,"/p>\n\n"));
			$editable
				.addClass('active-inline')
				.empty();
			

			// Determine what kind of form element we need
			var editElement = $editable.hasClass('editable') ? 
				'<input type="text" style="width: '+editWidth+'px; height: '+editHeight+'px; margin-bottom: 0px;" />' : '<textarea style="width: '+editWidth+'px; height: '+editHeight+'px;" ></textarea>';

			// Replace the target with the form element
			$(editElement)
				.val(contents)
				.appendTo($editable)
				.focus()
				.blur(function(event) {
					$editable.trigger('blur');
				});
		})		
		.blur(function(event) {// end the inline editing
			var $editable = $(this);
	
			var edited = $editable.find(':first-child').val();
			$editable.children().replaceWith('<em class="ajax">—охран€ю</em>');
	


			// post the new value to the server along with its ID
			$.post('', {
					id: $editable.attr('id'),
					type: $editable.attr('type'),
					value: edited
				},
				function(data) {

				if (data == 'ok') {
					$editable
						.removeClass('active-inline')
						.children()
						.replaceWith(edited);

					if ($editable.hasClass('editable-area')) {
						rapture($editable);	
					}
				} else {
					alert('ќшибка сохранени€!');
				}

				}
			);



		});
});



