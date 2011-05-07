<?php $return = '  	<div id="feature-slideshow-container">
	                <div id="feature-slideshow">
                    
                    	<ul id="tabs">';
						
								$fs_height = ($feature_slideshow_settings['numberposts'] * 81) - 1;
								$fs_width = $feature_slideshow_settings['width'] - $feature_slideshow_settings['list_width'];
                    
								$posts = get_posts("numberposts=" . $numberposts . "&orderby=" . $orderby . "&post_parent=" . $post_parent . "&post_type=" . $post_type . "&category=" . $category . "&tag=" . $tag);
                                
                                if($posts) {
                                    foreach($posts as $post):
                                        setup_postdata($post);
										
										$metadata = get_post_custom( $post->ID );
										
										$return .= '<li>
                                            <a href="javascript:;">
                                                <h3>' . get_the_title($post->ID) . '</h3>
                                                <span>' . $metadata['feature_slideshow_description'][0] . '</span>
                                            </a>
                                        </li>';
                                       
									endforeach;
                                }
								
                            
                            
                        
                        $return .= '</ul>
                        
                        <ul id="output">';
                    
                                $posts = get_posts("numberposts=" . $numberposts . "&orderby=" . $orderby . "&post_parent=" . $post_parent . "&post_type=" . $post_type . "&category=" . $category . "&tag=" . $tag);
                                
                                if($posts) {
                                    foreach($posts as $post):
                                        setup_postdata($post);
										
											$metadata = get_post_custom( $post->ID );
											
											if( isset($metadata['feature_slideshow_overlay'][0]) && $metadata['feature_slideshow_overlay'][0] != "" ) {
												$overlay = '<p>' . $metadata['feature_slideshow_overlay'][0] . '</p>';
											} else {
												$overlay = '';
											}
										
											$image = '<img src="' . FEATURE_SLIDESHOW_DIR . '/timthumb.php?src=' . get_thumbnail_url() . '&h=' . $fs_height . '&w=' . $fs_width . '&zc=1" alt="" />';
                                
                                        $return .= '<li>
                                            <a href="' . get_permalink($post->ID) . '">' . $image . '</a>'.
                                            $overlay .'
                                        </li>';
                                       
									endforeach;
                                }
								
                        
                        $return .= '</ul>
                        
                        <div class="clear"></div>
                        
                    </div>
					</div>';