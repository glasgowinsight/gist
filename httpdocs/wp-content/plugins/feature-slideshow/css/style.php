<?php
	Header("Content-type: text/css");
	
	$feature_slideshow_width 		= strip_tags($_GET['width']);
	$feature_slideshow_list_width 	= strip_tags($_GET['list_width']);
	$feature_slideshow_title_color	= strip_tags($_GET['title_color']);
	$feature_slideshow_height 		= strip_tags($_GET['height']);
	$feature_slideshow_image_width 	= strip_tags($_GET['imagewidth']);
	$feature_slideshow_p_size 		= strip_tags($_GET['psize']);
?>

#feature-slideshow-container {
	margin: 0;
	padding: 5px;
    background: #fff;
    border: 1px solid #ccc;
    width: <?php echo $feature_slideshow_width; ?>px;
}

#feature-slideshow {
	width: <?php echo $feature_slideshow_width; ?>px;
	height: <?php echo $feature_slideshow_height; ?>px;
	overflow: hidden;
	position: relative;
}

        #feature-slideshow h3 {
            margin: 0 0 5px 0;	
            padding: 0;
            font-size: 16px;
            line-height: 1;
            white-space: nowrap;
            overflow: hidden;
            height: 22px;
        }

		#feature-slideshow ul {
			position: absolute;
			top: 0;
			list-style: none!important;	
			padding: 0;
			margin: 0;
            height: <?php echo $feature_slideshow_height; ?>px;
		}

		#feature-slideshow ul#tabs {
			left: 0;
			z-index: 2;
			width: <?php echo ($feature_slideshow_list_width + 33); ?>px;
            list-style: none !important;
            margin: 0;
            padding: 0;
		}

		#feature-slideshow ul#tabs li {
			font-size: 12px;
			font-family: Arial;
			width: <?php echo ($feature_slideshow_list_width); ?>px;
			margin: 1px 33px 0 0;
            padding: 0;
			background: url(images/feature-tab-link.png) center left repeat-x;
		}
		
		#feature-slideshow ul#tabs li:first-child {
			margin: 0 33px 0 0;
		}
		
		#feature-slideshow #tabs li img {
			padding: 5px;
			border: none;
			float: left;
			margin: 10px 10px 0 0;
		}

		#feature-slideshow ul#tabs li a {
			color: #999;
			text-decoration: none;	
			display: block;
			padding: 10px;
			height: 60px;
			outline: none;
            line-height: 1;
		}
		
		#feature-slideshow ul#tabs li a:hover {
			color: #999 !important;
		}
		
		#feature-slideshow ul#tabs li a h3 {
			font-family: Georgia, "Times New Roman", Times, serif;
			color: #<?php echo $feature_slideshow_title_color; ?>;;
			font-size: 21px;
		}
		
		#feature-slideshow ul#tabs li a span {
			font-size: 12px;
			line-height: 1.2;
		}

		#feature-slideshow ul#tabs li a.current {
			background: url('images/feature-tab-current.png') right center no-repeat;
			width: <?php echo ($feature_slideshow_list_width + 33); ?>;px;
			color: #333;
            margin-right: -33px;
		}
		
		#feature-slideshow ul#tabs li a.current:hover {
			color: #333 !important;
		}

		#feature-slideshow ul#tabs li a.current:hover {
			text-decoration: none;
			cursor: default;
		}

		#feature-slideshow ul#output {
			left: <?php echo $feature_slideshow_list_width; ?>px;
			width: <?php echo $feature_slideshow_image_width; ?>px;
			height: <?php echo $feature_slideshow_height; ?>px;
			position: relative;
            list-style: none!important;	
			padding: 0;
			margin: 0;
		}

		#feature-slideshow ul#output li {
			position: absolute;
			width: <?php echo $feature_slideshow_image_width; ?>px;
			height: <?php echo $feature_slideshow_height; ?>px;
            margin: 0;
            padding: 0;
		}
        
        #feature-slideshow ul#output li a img {
        	margin: 0;
            padding: 0;
            boreder: 0;
            border-style: none;
        }
		
		#feature-slideshow ul#output li p {
			width: <?php echo $feature_slideshow_p_width; ?>px;
			position: absolute;
			bottom: 10px;
			right: 15px;
			font-size: <?php echo $feature_slideshow_p_size; ?>px;
			line-height: 1.6;
			color: #000;
			background: #FFF;
			padding: 10px 20px;
			
			filter:alpha(opacity=70);
			-moz-opacity:0.7;
			-khtml-opacity: 0.7;
			opacity: 0.7;
		}
        
        #feature-slideshow  .clear {
        	width: 100%;
            clear: both;
        }