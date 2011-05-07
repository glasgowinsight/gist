<div class="wrap">

	<?php if(isset($_POST['submit'])) :
	
		function check_int($value) {
			if( !is_numeric($value) ) {
				$value = '0';
			}
			return $value;
		}
    	
		$_POST['fs_width'] = check_int($_POST['fs_width']);
		$_POST['fs_numberposts'] = check_int($_POST['fs_numberposts']);
		
		$settings = get_option('feature_slideshow_settings');
		
		$settings['width'] 					= 	$_POST['fs_width'];
		$settings['list_width'] 			= 	$_POST['fs_list_width'];
		$settings['title_color'] 			= 	$_POST['fs_title_color'];
		$settings['numberposts']			= 	$_POST['fs_numberposts'];
		$settings['orderby'] 				= 	$_POST['fs_orderby'];
		$settings['post_parent'] 			= 	$_POST['fs_post_parent'];
		$settings['post_type'] 				= 	$_POST['fs_post_type'];
		$settings['category'] 				= 	$_POST['fs_category'];
		$settings['p_size'] 				= 	$_POST['fs_p_size'];
		$settings['transition_interval'] 	= 	$_POST['fs_transition_interval'];
		
		
		update_option('feature_slideshow_settings', $settings);
		
	?>
		
		<div class="updated"><p><strong> <?php _e('Settings saved.'); ?> </strong></p></div>
    
   <?php endif; ?>
   

		<?php		
            $settings = get_option('feature_slideshow_settings');
			
			$orderbyArray = array(
				'author'		=> 'author',
				'category' 		=> 'category',
				'content' 		=> 'content',
				'date' 			=> 'date',
				'ID' 			=> 'ID',
				'menu_order'	=> 'menu_order',
				'mime_type' 	=> 'mime_type',
				'modified' 		=> 'modified',
				'name' 			=> 'name',
				'parent' 		=> 'parent',
				'password' 		=> 'password',
				'rand' 			=> 'rand',
				'status' 		=> 'status',
				'title' 		=> 'title',
				'type' 			=> 'type',
			);
            
        ?>
        
        <script>
			jQuery(document).ready( function() {
				jQuery('#feature_advanced_settings').hide();
				
				jQuery('#show_advanced').click( function() {
					jQuery('#feature_advanced_settings').toggle('slow');
					jQuery('#show_advanced').toggle();
				});
				
				jQuery('#hide_advanced').click( function() {
					jQuery('#feature_advanced_settings').toggle('slow');
					jQuery('#show_advanced').toggle();
				});
				
				jQuery('#colorpicker').ColorPicker({
					onSubmit: function(hsb, hex, rgb, el) {
						jQuery(el).val(hex);
						jQuery(el).ColorPickerHide();
					},
					onBeforeShow: function () {
						jQuery(this).ColorPickerSetColor(this.value);
					}
				});
			});
		</script>
    
        <h2> <?php _e('Feature Slideshow Options'); ?> </h2>
        
        <form name="feature_slideshow_form" method="post" action="">
        
            <h4> <?php _e('Visual settings'); ?> </h4>
            
            	<table class="form-table">
                	<tr valign="top">
                        <th scope="row"><label for="fs_width"><?php _e('Slideshow width: '); ?></label></th> <td><input type="text" name="fs_width" value="<?php echo $settings['width']; ?>" /><span class="description"> Width of slideshow in px</span></td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><label for="fs_list_width"><?php _e('List width: '); ?></label></th> <td><input type="text" name="fs_list_width" value="<?php echo $settings['list_width']; ?>" /><span class="description"> Width of list in slideshow in px</span></td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php _e('Overlay text size: '); ?></th>
                        <td><input type="text" name="fs_p_size" value="<?php echo $settings['p_size']; ?>" /><span class="description"> Size of overlay text in px</span></td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php _e('Title color: '); ?></th>
                        <td><input type="text" name="fs_title_color" value="<?php echo $settings['title_color']; ?>" id="colorpicker" /><span class="description"> Color of titles in list</span></td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php _e('Transition interval: '); ?></th>
                        <td><input type="text" name="fs_transition_interval" value="<?php echo $settings['transition_interval']; ?>" /><span class="description"> Time between slide change in seconds</span></td>
                    </tr>
                </table>
                
                <h4> <?php _e('Post settings'); ?> </h4>
                
                <table class="form-table">
                
                	<tr valign="top">
                        <th scope="row"><?php _e('Number of posts: '); ?></th>
                        <td><input type="text" name="fs_numberposts" value="<?php echo $settings['numberposts']; ?>" /><span class="description"> Number of posts to show</span></td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php _e('Post type: '); ?></th>
                        <td>
                        <select name="fs_post_type">
                            <?php if($settings['post_type'] == 'post') : ?>
                                <option value="post">Post</option>
                                <option value="page">Page</option>
                            <?php else : ?>
                                <option value="page">Page</option>
                                <option value="post">Post</option>
                            <?php endif; ?>
                        </select>
                        </td>
                    </tr>
                    
                </table>
                
                <div id="feature_advanced_settings">
                
                <h4> <?php _e('Advanced settings'); ?> </h4>
                
                <table class="form-table">
                
                	<tr valign="top">
                        <th scope="row"><?php _e('Order by: '); ?></th>
                        <td>
                        <select name="fs_orderby">
                            <option value="<?php echo $settings['orderby']; ?>"><?php echo $settings['orderby']; ?></option>
                        <?php                                    
                            foreach($orderbyArray as $value) {
								if($value != $settings['orderby'])
								{
                                	echo '<option value="' . $value . '">' . $value . '</option>';
								}
                            }
                        ?>
                        
                        </select>
                        </td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php _e('Child of: '); ?></th>
                        <td><input type="text" name="fs_post_parent" value="<?php echo $settings['post_parent']; ?>" /><span class="description"> ID of parent page (optional)</span></td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row"><?php _e('Category: '); ?></th>
                        <td><input type="text" name="fs_category" value="<?php echo $settings['category']; ?>" /><span class="description"> Category ID. Making the category ID negative (-3 rather than 3) will show results not matching that category ID. (optional)</span></td>
                    </tr>
                    
                    <tr>
                    	<td><input type="button" id="hide_advanced" value="Hide advanced settings" /></td>
                    </tr>
                
                </table>
                </div>
                
                <p><input type="button" id="show_advanced" value="Show advanced options" /></p>
            
            <p class="submit">
                <input type="submit" name="submit" value="<?php _e('Save settings'); ?>" />
            </p>
        
        </form>
        
</div>