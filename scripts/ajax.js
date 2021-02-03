$(document).ready(function(){
	$('#nav-load a').on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
		let pageCount = $(this).data('page-num'),
			offset = $(this).data('offset'),
			cont = $('#dle-content'),
			thisBtn = $(this);
			url = fp_posts.url;	
		$.ajax({
			type: 'POST',
			url: url,
			data: {
				action: 'fp_posts',
				offset: offset
			}, 
			success: function(resp) {
				if(resp != 'nth') {
					cont.append(resp);
					thisBtn.data('offset', ++offset);

					if(pageCount <= offset ){
						thisBtn.remove();
					}
				} 
			}
		});
	})
});