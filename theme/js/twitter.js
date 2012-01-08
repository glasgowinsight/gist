jQuery(document).ready( show_tweets )

function show_tweets(){
	new TWTR.Widget({
		  id: 'twtr-widget',
		  version: 2,
		  type: 'profile',
		  rpp: 3,
		  interval: 6000,
		  footer: '',
		  theme: {
		    shell: {
		      background: 'rgb(255,234,115)',
		      color: '#ffffff'
		    },
		    tweets: {
		      background: '#FFFFFF',
		      color: '#000000',
		      links: '#000000'
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