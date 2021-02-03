function showOverlay(){
	$('.overlay-box').fadeIn(200);
};
function hideOverlay(){
	$('.overlay-box').fadeOut(200);
};
$(document).ready(function(){
	
	var tempScrollTop, currentScrollTop = 0;
	var header = $('#header'), headerPos = header.offset().top, headerHeight = header.outerHeight(), stickyHide = headerPos + 180; 
	header.wrap('<div style="height:'+headerHeight+'px"></div>');
	$(window).scroll(function(){	
		if ($(this).scrollTop () > headerPos) {
			header.addClass('sticky')
		} else {
			header.removeClass('sticky')
		};
		if ($(this).scrollTop () > stickyHide) {
			header.addClass('sticky-hide')
		} else {
			header.removeClass('sticky-hide')
		};
		currentScrollTop = $(window).scrollTop();
		if (tempScrollTop < currentScrollTop ) {
			header.removeClass('sticky-vis')
		} else if (tempScrollTop > currentScrollTop ) {
			header.addClass('sticky-vis')
		};
		tempScrollTop = currentScrollTop;
	}); 
	
	$('body').on('click','.ft-soc span',function(){
		var $url = $(this).attr("data-href");
		window.open($url);
	});
	
	$('body').on('click','#nav-load a',function(){
		var urlNext = $(this).attr('href');
		var scrollNext = $(this).offset().top - 200;
        if (urlNext !== undefined) {
			$.ajax({
				url: urlNext,
				beforeSend: function() {
					ShowLoading('');
				},			 
                success: function(data) {
                    $('#bottom-nav').remove();
                    $('#dle-content').append($('#dle-content', data).html());
                    $('#dle-content').after($('#bottom-nav'));
					window.history.pushState("", "", urlNext);
					$('html, body').animate({scrollTop:scrollNext}, 800);	
					HideLoading('');
                },
				  error: function() {				
					HideLoading('');
					alert('что-то пошло не так');
				  }
			});
		};
		return false;
	});
	
	$('body').on('click','.js-search',function(){
		showOverlay();
		$('.search-wrap').fadeIn(200).find('.search-box input').focus();
	});
	$('body').on('click','.overlay-box, .login-close, .search-close, .btn-close',function(){
		$('.login-box, .search-wrap').fadeOut(200);
		$('#side-panel, .btn-close').removeClass('active');
		$('body').removeClass('opened-menu');
		hideOverlay();
	});
	
	$('body').append('<div class="overlay-box hidden"></div><div class="side-panel" id="side-panel"></div><div class="btn-close"><span class="far fa-times"></span></div><div id="gotop"><span class="fas fa-chevron-up"></span></div>');
	$('.to-mob').each(function() {
		$(this).clone().appendTo('#side-panel');
	});		
	$(".btn-menu").click(function(){
		showOverlay();
		$('#side-panel, .btn-close').addClass('active');
		$('body').addClass('opened-menu');
	});
	
	
	$('body').on('click','.faddcomms',function(){
		$(".fcomms").slideToggle(200);
		setTimeout(() => {
		  $('html, body').animate({ scrollTop : $('.fcomms').offset().top-70 }, 'slow');
		}, 210)
	});
	$('body').on('click','.reply',function(){
		$("#add-comms").slideDown(200);
	});
	$('body').on('click','.ac-textarea textarea, .fr-wrapper',function(){
		$('.add-comms').addClass('active').find('.ac-protect').slideDown(400);
	});

    $('#dle-content > #dle-ajax-comments').appendTo($('#full-comms')); 
	
	var $gotop=$('#gotop'); 
	$(window).scroll (function () {
		if ($(this).scrollTop () > 300) {$gotop.fadeIn(200);
		} else {$gotop.fadeOut(200);}
	});	
	$gotop.click(function(){
		$('html, body').animate({ scrollTop : 0 }, 'slow');
	});
	
	$('body').on('click', '.fshare > *', function() {
		var id = $(this).data('id');
		social_share(id);
	});
});

function social_share(id) {
    var like_title = encodeURIComponent(document.title),
        like_url = encodeURIComponent(window.location.href),
        like_image = encodeURIComponent($('meta[property="og:image"]').attr('content'));
    if (like_image == undefined) {
        like_image = '';
    }
    if (id == 'vk') {
        var url = "https://vk.com/share.php?title=" + like_title + "&description=" + "&url=" + like_url + "&image=" + like_image + "&nocache-";
    } else if (id == 'fb') {
        var url = "https://www.facebook.com/sharer.php?s=100&p[title]=" + like_title + "&p[url]=" + like_url + "&p[images][0]=" + like_image + "&nocache-";
    } else if (id == 'tw') {
        var url = "https://twitter.com/share?text=" + like_title + "&url=" + like_url + "&counturl=" + like_url + "&nocache-";
    } else if (id == 'ggl') {
        var url = "https://plus.google.com/share?url=" + like_url + "&title=" + like_title + "&imageurl=" + like_image;
    } else if (id == 'ok') {
        var url = "https://connect.ok.ru/offer?url=" + like_url;
    } else if (id == 'tlg') {
        var url = "https://telegram.me/share/url?url=" + like_url + "&text=" + like_title;
    }
    window.open(url, '', 'toolbar=0,status=0,width=655,height=430');
};

/* end */

hs.graphicsDir = '/wp-content/themes/nano/scripts/highslide/graphics/';
hs.wrapperClassName = 'rounded-white';
hs.outlineType = 'rounded-white';
hs.numberOfImagesToPreload = 0;
hs.captionEval = 'this.thumb.alt';
hs.showCredits = false;
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];

hs.lang = { loadingText : 'Загрузка...', playTitle : 'Просмотр слайдшоу (пробел)', pauseTitle:'Пауза', previousTitle : 'Предыдущее изображение', nextTitle :'Следующее изображение',moveTitle :'Переместить', closeTitle :'Закрыть (Esc)',fullExpandTitle:'Развернуть до полного размера',restoreTitle:'Кликните для закрытия картинки, нажмите и удерживайте для перемещения',focusTitle:'Сфокусировать',loadingTitle:'Нажмите для отмены'
};
hs.slideshowGroup='fullnews'; 
hs.addSlideshow({slideshowGroup: 'fullnews', interval: 4000, repeat: false, useControls: true, fixedControls: 'fit', overlayOptions: { opacity: .75, position: 'bottom center', hideOnMouseOut: true } });