$(document).ready( show_tweets )

$(document).ready( function(){ 
	$.post(
			gist.ajaxurl,
			{action: 'load_slider'},
			load_slider
	)
});

function load_slider(response){
	// I've possibly entirely over-engineered this just to get some pre-loading
	
	var slides = $(response.slides)
	var thumbs = $(response.thumbs)
	var imgs = $.merge(slides.find('img'), thumbs.find('img'));

	var called = false;
	var start = function() {
		if(!called){
			// There's a bit of a race condition here, but should be rare
			// and worst case is it replaces the div contents twice
			called = true;
			clearTimeout(timeout);
			$('#slider').empty();
			$('#slider').append(slides);
			$('#slider-thumbs').empty();
			$('#slider-thumbs').append(thumbs);
			start_slider();
		}
	}
	
	// Don't load the slider into the div until all
	// the images and thumbnails have been loaded
	var i = 0;
	var count_imgs = function(){
		i++;
		if(i>=imgs.length){
			start();
		}
	}; 
	imgs.load(count_imgs);
	
	// Sometimes not all the onload events get fired especially
	// if they've been cached
	var timeout=setTimeout(start, 10000);
}

function start_slider(){
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
	
    simpleSlide({'auto_speed': 10000});
}

function show_tweets(){
	new TWTR.Widget({
		  id: 'twtr-widget',
		  version: 2,
		  type: 'profile',
		  rpp: 3,
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
