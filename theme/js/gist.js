function show_tweets() {
	new TWTR.Widget({
		  version: 2,
		  type: 'profile',
		  rpp: 4,
		  interval: 6000,
		  width: 200,
		  height: 300,
		  footer: '',
		  theme: {
		    shell: {
		      background: '#2857af',
		      color: '#ffffff'
		    },
		    tweets: {
		      background: '#E5E8FF',
		      color: '#000000',
		      links: '#a16106'
		    }
		  },
		  features: {
		    scrollbar: false,
		    loop: false,
		    live: false,
		    hashtags: true,
		    timestamp: false,
		    avatars: false,
		    behavior: 'all'
		  }
		}).render().setUser('GlasgowGist').start();
}

$(document).ready( function(){ 
	$('.noscript').removeClass("noscript");
    
	$('.simpleSlide-window').each(function(){
		var width = $(this).outerWidth();
		var max_height = 0;
		$(this).find('.simpleSlide-slide').each(function(){
			$(this).css({
				'width': width
			});
			var height = $(this).outerHeight();
			if ( height > max_height) {
				max_height = height;
			}
			
		});
		$(this).find('.simpleSlide-slide').css({
			'height': max_height
		});
	}); 

	$('.jump-to[alt="1"]').addClass('current');
	$('.jump-to').hover(
		function(){$(this).addClass('hover');},
		function(){$(this).removeClass('hover');}
	);
	
    simpleSlide();
});

