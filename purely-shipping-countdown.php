<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/*
Plugin Name: Shipping Countdown
Plugin URI: http://purelythemes.com/shipping-countdown
Description: Countdown until next shipping time. Created for WooCommerce Product Pages For Customer Inticement, but can be used for other things requiring different behavior mon-fri and sat-sun.
Version: 1.1
Author: PurelyThemes
Author URI: http://www.purelythemes.com
License: GNU GPLv2
*/


class purely_shipping_countdown extends WP_Widget {

	// constructor
	function purely_shipping_countdown() {
		parent::WP_Widget(false, $name = __('Shipping Countdown', 'purely_shipping_countdown') );
		add_action('wp_footer', array($this, 'purely_shipping_countdown_css'));
		add_action( 'woocommerce_single_product_summary', array($this, 'purely_shipping_countdown_widget'), 19 );
		
	// adding sidebar area for product display in woocommerce
		register_sidebar( array(
		'name' =>__( 'Product Sidebar', 'purely_shipping_countdown'),
		'id' => 'purely-product-sidebar',
		'description' => __( 'Displayed on product page', 'purely_shipping_countdown' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	}
	
	// widget form creation
	function form($instance) {

		// Check values
		if($instance) {
			$title = esc_attr($instance['title']);

			$text_before = esc_attr($instance['text_before']);
			$text_after = esc_attr($instance['text_after']);
			$shipping_mon = esc_attr($instance['shipping_mon']);
			$shipping_tue = esc_attr($instance['shipping_tue']);
			$shipping_wed = esc_attr($instance['shipping_wed']);
			$shipping_thu = esc_attr($instance['shipping_thu']);
			$shipping_fri = esc_attr($instance['shipping_fri']);
			$shipping_sat = esc_attr($instance['shipping_sat']);
			$shipping_sun = esc_attr($instance['shipping_sun']);
			$shipping_weekend = esc_attr($instance['shipping_weekend']);
			$shipping_language = esc_attr($instance['shipping_language']);
			$countdown_theme = esc_attr($instance['countdown_theme']);
			
		} else {
			$title = '';
			$text_before = '';
			$text_after = '';
			$shipping_mon = '';
			$shipping_tue = '';
			$shipping_wed = '';
			$shipping_thu = '';
			$shipping_fri = '';
			$shipping_sat = '';
			$shipping_sun = '';
			$shipping_weekend = '';
			$shipping_language = '';
			$countdown_theme = '';
		}
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'purely_shipping_countdown'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			
			
			
			<p>
				<label for="<?php echo $this->get_field_id('text_before'); ?>"><?php _e('Text before timer', 'purely_shipping_countdown'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('text_before'); ?>" name="<?php echo $this->get_field_name('text_before'); ?>" type="text" value="<?php echo $text_before; ?>" />
			</p>

			
			<p>
				<label for="<?php echo $this->get_field_id('text_after'); ?>"><?php _e('Text after timer', 'purely_shipping_countdown'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('text_after'); ?>" name="<?php echo $this->get_field_name('text_after'); ?>" type="text" value="<?php echo $text_after; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('shipping_mon'); ?>"><?php _e('Monday time (in 24hr format eg. 16:30)', 'purely_shipping_countdown'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('shipping_mon'); ?>" name="<?php echo $this->get_field_name('shipping_mon'); ?>" type="text" value="<?php echo $shipping_mon; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('shipping_tue'); ?>"><?php _e('Tuesday time (in 24hr format eg. 16:30)', 'purely_shipping_countdown'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('shipping_tue'); ?>" name="<?php echo $this->get_field_name('shipping_tue'); ?>" type="text" value="<?php echo $shipping_tue; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('shipping_wed'); ?>"><?php _e('Wednesday time (in 24hr format eg. 16:30)', 'purely_shipping_countdown'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('shipping_wed'); ?>" name="<?php echo $this->get_field_name('shipping_wed'); ?>" type="text" value="<?php echo $shipping_wed; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('shipping_thu'); ?>"><?php _e('Thursday time (in 24hr format eg. 16:30)', 'purely_shipping_countdown'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('shipping_thu'); ?>" name="<?php echo $this->get_field_name('shipping_thu'); ?>" type="text" value="<?php echo $shipping_thu; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('shipping_fri'); ?>"><?php _e('Friday time (in 24hr format eg. 16:30)', 'purely_shipping_countdown'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('shipping_fri'); ?>" name="<?php echo $this->get_field_name('shipping_fri'); ?>" type="text" value="<?php echo $shipping_fri; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('shipping_sat'); ?>"><?php _e('Saturday time (in 24hr format eg. 16:30)', 'purely_shipping_countdown'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('shipping_sat'); ?>" name="<?php echo $this->get_field_name('shipping_sat'); ?>" type="text" value="<?php echo $shipping_sat; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('shipping_sun'); ?>"><?php _e('Sunday time (in 24hr format eg. 16:30)', 'purely_shipping_countdown'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('shipping_sun'); ?>" name="<?php echo $this->get_field_name('shipping_sun'); ?>" type="text" value="<?php echo $shipping_sun; ?>" />
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('shipping_weekend'); ?>" name="<?php echo $this->get_field_name('shipping_weekend'); ?>" type="checkbox" value="1" <?php checked( '1', $shipping_weekend ); ?> />
				<label for="<?php echo $this->get_field_id('shipping_weekend'); ?>"><?php _e('Do not ship on weekends?', 'purely_shipping_countdown'); ?></label>
			</p>
						
			<p>
				<label for="<?php echo $this->get_field_id('shipping_language'); ?>"><?php _e('Timer Language', 'purely_shipping_countdown'); ?></label>
				<select name="<?php echo $this->get_field_name('shipping_language'); ?>" id="<?php echo $this->get_field_id('shipping_language'); ?>" class="widefat" >
					<option value="en"<?php echo ($shipping_language=='en')?'selected':''; ?>>English</option>
					<option value="ar"<?php echo ($shipping_language=='ar')?'selected':''; ?>>Arabic</option>
					<option value='bg'<?php echo ($shipping_language=='bg')?'selected':''; ?>>Bulgarian</option> 
					<option value='bn'<?php echo ($shipping_language=='bn')?'selected':''; ?>>Bengali</option> 
					<option value='bs'<?php echo ($shipping_language=='bs')?'selected':''; ?>>Bosnian</option> 
					<option value='ca'<?php echo ($shipping_language=='ca')?'selected':''; ?>>Catalan</option> 
					<option value='cs'<?php echo ($shipping_language=='cs')?'selected':''; ?>>Czech</option> 
					<option value='cy'<?php echo ($shipping_language=='cy')?'selected':''; ?>>Welsh</option> 
					<option value='da'<?php echo ($shipping_language=='da')?'selected':''; ?>>Danish</option> 
					<option value='de'<?php echo ($shipping_language=='de')?'selected':''; ?>>German</option> 
					<option value='el'<?php echo ($shipping_language=='el')?'selected':''; ?>>Greek</option> 
					<option value='et'<?php echo ($shipping_language=='et')?'selected':''; ?>>Estonian</option> 
					<option value='fa'<?php echo ($shipping_language=='fa')?'selected':''; ?>>Farsi/Persian</option> 
					<option value='fi'<?php echo ($shipping_language=='fi')?'selected':''; ?>>Finnish</option> 
					<option value='fo'<?php echo ($shipping_language=='fo')?'selected':''; ?>>Faroese</option> 
					<option value='fr'<?php echo ($shipping_language=='fr')?'selected':''; ?>>French</option> 
					<option value='gl'<?php echo ($shipping_language=='gl')?'selected':''; ?>>Galician</option> 
					<option value='gu'<?php echo ($shipping_language=='gu')?'selected':''; ?>>Gujarati</option> 
					<option value='he'<?php echo ($shipping_language=='he')?'selected':''; ?>>Hebrew</option> 
					<option value='hr'<?php echo ($shipping_language=='hr')?'selected':''; ?>>Croatian</option> 
					<option value='hu'<?php echo ($shipping_language=='hu')?'selected':''; ?>>Hungarian</option> 
					<option value='hy'<?php echo ($shipping_language=='hy')?'selected':''; ?>>Armenian</option> 
					<option value='id'<?php echo ($shipping_language=='id')?'selected':''; ?>>Indonesian</option> 
					<option value='is'<?php echo ($shipping_language=='is')?'selected':''; ?>>Icelandic</option> 
					<option value='it'<?php echo ($shipping_language=='it')?'selected':''; ?>>Italian</option> 
					<option value='ja'<?php echo ($shipping_language=='ja')?'selected':''; ?>>Japanese</option> 
					<option value='kn'<?php echo ($shipping_language=='kn')?'selected':''; ?>>Kannda</option> 
					<option value='ko'<?php echo ($shipping_language=='ko')?'selected':''; ?>>Korean</option> 
					<option value='lt'<?php echo ($shipping_language=='lt')?'selected':''; ?>>Lithuanian</option> 
					<option value='lv'<?php echo ($shipping_language=='lv')?'selected':''; ?>>Latvian</option> 
					<option value='ml'<?php echo ($shipping_language=='ml')?'selected':''; ?>>Malayalam</option> 
					<option value='ms'<?php echo ($shipping_language=='ms')?'selected':''; ?>>Malaysian</option> 
					<option value='my'<?php echo ($shipping_language=='my')?'selected':''; ?>>Burmese</option> 
					<option value='nl'<?php echo ($shipping_language=='nl')?'selected':''; ?>>Dutch</option> 
					<option value='pl'<?php echo ($shipping_language=='pl')?'selected':''; ?>>Polish</option> 
					<option value='pt-BR'<?php echo ($shipping_language=='pt-BR')?'selected':''; ?>>Portugese</option> 
					<option value='ro'<?php echo ($shipping_language=='ro')?'selected':''; ?>>Romanian</option> 
					<option value='ru'<?php echo ($shipping_language=='ru')?'selected':''; ?>>Russian</option> 
					<option value='sk'<?php echo ($shipping_language=='sk')?'selected':''; ?>>Slovakian</option> 
					<option value='sl'<?php echo ($shipping_language=='sl')?'selected':''; ?>>Slovenian</option> 
					<option value='sr'<?php echo ($shipping_language=='sr')?'selected':''; ?>>Serbian</option> 
					<option value='sr-SR'<?php echo ($shipping_language=='sr-SR')?'selected':''; ?>>Srpski Jezik Serbian</option> 
					<option value='sv'<?php echo ($shipping_language=='sv')?'selected':''; ?>>Swedish</option> 
					<option value='tr'<?php echo ($shipping_language=='tr')?'selected':''; ?>>Turkish</option> 
					<option value='uk'<?php echo ($shipping_language=='uk')?'selected':''; ?>>Ukranian</option> 
					<option value='ur'<?php echo ($shipping_language=='ur')?'selected':''; ?>>Urdu</option> 
					<option value='vi'<?php echo ($shipping_language=='vi')?'selected':''; ?>>Vietnamese</option> 
					<option value='zh-CN'<?php echo ($shipping_language=='zh-CN')?'selected':''; ?>>Chinese simplified</option> 
					<option value='zh-TW'<?php echo ($shipping_language=='zh-TW')?'selected':''; ?>>Chinese traditional</option> 
				</select>                
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('countdown_theme'); ?>"><?php _e('Countdown Theme', 'purely_shipping_countdown'); ?></label>
				<select name="<?php echo $this->get_field_name('countdown_theme'); ?>" id="<?php echo $this->get_field_id('countdown_theme'); ?>" class="widefat" >
					<option value="default"<?php echo ($countdown_theme=='default')?'selected':''; ?>>Default</option>
					<option value="black"<?php echo ($countdown_theme=='black')?'selected':''; ?>>Black</option>
					<option value='white'<?php echo ($countdown_theme=='white')?'selected':''; ?>>White</option> 
					<option value='circles'<?php echo ($countdown_theme=='circles')?'selected':''; ?>>Circles</option> 
				</select>                
			</p>

			
			
<?php 
	}
	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
	// Fields
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text_before'] = strip_tags($new_instance['text_before']);
		$instance['text_after'] = strip_tags($new_instance['text_after']);

		$instance['shipping_mon'] = strip_tags($new_instance['shipping_mon']);
		$instance['shipping_tue'] = strip_tags($new_instance['shipping_tue']);
		$instance['shipping_wed'] = strip_tags($new_instance['shipping_wed']);
		$instance['shipping_thu'] = strip_tags($new_instance['shipping_thu']);
		$instance['shipping_fri'] = strip_tags($new_instance['shipping_fri']);
		$instance['shipping_sat'] = strip_tags($new_instance['shipping_sat']);
		$instance['shipping_sun'] = strip_tags($new_instance['shipping_sun']);
		
		$instance['shipping_weekend'] = strip_tags($new_instance['shipping_weekend']);
		$instance['shipping_language'] = strip_tags($new_instance['shipping_language']);
		$instance['countdown_theme'] = strip_tags($new_instance['countdown_theme']);
	return $instance;
	}
	function purely_shipping_countdown_widget() {
		// add sidebar
		dynamic_sidebar('purely-product-sidebar');

	}	

	function purely_shipping_countdown_css() {
		global $shipping_language;
		global $countdown_theme;
		if ( !empty($countdown_theme) && $countdown_theme != 'default') {
			wp_register_style('purely_shipping_countdown_css', plugins_url('/css/purely-shipping-countdown-'.$countdown_theme.'.css', __FILE__));
		}
		else {
			wp_register_style('purely_shipping_countdown_css', plugins_url('/css/purely-shipping-countdown.css', __FILE__));
		}
		wp_enqueue_style('purely_shipping_countdown_css');

		wp_register_script('purely_shipping_countdown_plugin', plugins_url('/js/jquery.plugin.js', __FILE__), array('jquery'));
		wp_enqueue_script('purely_shipping_countdown_plugin');

		wp_register_script('purely_shipping_countdown_keith', plugins_url('/js/jquery.countdown.js', __FILE__), array('jquery'));
		wp_enqueue_script('purely_shipping_countdown_keith');
	
		if ( !empty($shipping_language) && $shipping_language != 'en') {
			wp_register_script('purely_shipping_countdown_language', plugins_url('/js/localisation/jquery.countdown-'.$shipping_language.'.js', __FILE__), array('jquery'));
			wp_enqueue_script('purely_shipping_countdown_language');
		}
		wp_register_script('purely_shipping_countdown_script', plugins_url('/js/purely-shipping-countdown.js', __FILE__), array('jquery'));
		wp_enqueue_script('purely_shipping_countdown_script');
	}

	// display widget
	function widget($args, $instance) {
	
		extract( $args );
	// these are the widget options
		global $countdown_theme;
		global $shipping_language;
				
		if (!empty($instance['title'])) { $title = apply_filters('widget_title', $instance['title']);}
		if (!empty($instance['text_before'])) { $text_before = $instance['text_before']; } else { $text_before = '';  }
		if (!empty($instance['text_after'])) { $text_after = $instance['text_after'];} else { $text_after = '';  }
		
		if (!empty($instance['shipping_mon'])) { $shipping_mon = $instance['shipping_mon'];}
		if (!empty($instance['shipping_tue'])) { $shipping_tue = $instance['shipping_tue'];}
		if (!empty($instance['shipping_wed'])) { $shipping_wed = $instance['shipping_wed'];}
		if (!empty($instance['shipping_thu'])) { $shipping_thu = $instance['shipping_thu'];}
		if (!empty($instance['shipping_fri'])) { $shipping_fri = $instance['shipping_fri'];}
		if (!empty($instance['shipping_sat'])) { $shipping_sat = $instance['shipping_sat'];}
		if (!empty($instance['shipping_sun'])) { $shipping_sun = $instance['shipping_sun'];}
				
		$shipping_weekend = $instance['shipping_weekend'];
		if (!empty($instance['countdown_theme'])) { $countdown_theme = $instance['countdown_theme'];}
		if (!empty($instance['shipping_language'])) { $shipping_language = $instance['shipping_language'];}
		
		global $user_lang;
		$user_lang = $shipping_language;
		
		echo $before_widget;
	// Display the widget
		echo '<div class="widget-text purely_shipping_countdown_box">';
	// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		?>
		
	<!-- Query with the dynamic arguments -->	
		<div class="purely-shipping-wrapper">
		<?php
		if ($text_before) {
			echo "<p>";
			echo $text_before;
			echo "</p>";
		} 	
			$shipping_timezone = get_option('timezone_string'); 
			date_default_timezone_set("$shipping_timezone");
			$server_datetime = date('Y-m-d H:i:s');
			$server_time = date('H:i:s');
			$server_day = date('w'); // Sunday is 0
			$shippingSeconds = '00';
			$shipping_date = date('Y-m-d');

			
			if ($server_day == 0 && $shipping_weekend == 0) { $shipping_time = "$shipping_sun:$shippingSeconds"; } // Sunday
			elseif ($server_day == 6 && $shipping_weekend == 0) { $shipping_time = "$shipping_sat:$shippingSeconds"; } // Saturday
			elseif (($server_day == 0 && $shipping_weekend == 1) || ($server_day == 1) || ($server_day == 6 && $shipping_weekend == 1)) { $shipping_time = "$shipping_mon:$shippingSeconds"; 	} // Monday - this is why monday is worse than other weekdays btw.
			elseif ($server_day == 2) { $shipping_time = "$shipping_tue:$shippingSeconds"; } // Tuesday
			elseif ($server_day == 3) { $shipping_time = "$shipping_wed:$shippingSeconds"; } // Wednesday
			elseif ($server_day == 4) { $shipping_time = "$shipping_thu:$shippingSeconds"; } // Thursday
			elseif ($server_day == 5) { $shipping_time = "$shipping_fri:$shippingSeconds"; } // Friday

			
			$shipping_server_diff = strtotime("$shipping_date $shipping_time")-strtotime($server_datetime);

		?>

		<?php if ($server_day == 0) { // Sunday
			if ($shipping_weekend == 0) {
				$date = strtotime("+0 days");
				$calculated_date = date('Y m d', $date);
			}
			else {
			$date = strtotime("+1 day"); 
			$calculated_date = date('Y m d',$date);
			}
		}
		elseif ($server_day == 1) { // Monday
			if ($server_time < $shipping_time && ($shipping_server_diff > 0 )) { 
				$date = strtotime("+0 days");
			}
			else {	
				$date = strtotime("+1 day"); 
				$shipping_time = "$shipping_tue:$shippingSeconds";
			}
			$calculated_date = date('Y m d',$date);
		} 
		elseif ($server_day == 2) { // Tuesday
			if ($server_time < $shipping_time && ($shipping_server_diff > 0) && ($hidetimer == 0)) { 
				$date = strtotime("+0 days");
			}
			else {	
				$date = strtotime("+1 day"); 
				$shipping_time = "$shipping_wed:$shippingSeconds";
			}
			$calculated_date = date('Y m d',$date);
		} 
		elseif ($server_day == 3) { // Wednesday
			if ($server_time < $shipping_time && ($shipping_server_diff > 0 )) { 
				$date = strtotime("+0 days");
			}
			else {	
				$date = strtotime("+1 day"); 
				$shipping_time = "$shipping_thu:$shippingSeconds";
			}
			$calculated_date = date('Y m d',$date);
		} 
		elseif ($server_day == 4) { // Thursday
			if ($server_time < $shipping_time && ($shipping_server_diff > 0 )) { 
				$date = strtotime("+0 days");
			}
			else {	
				$date = strtotime("+1 day");
				$shipping_time = "$shipping_fri:$shippingSeconds";				
			}
			$calculated_date = date('Y m d',$date);
		} 
		elseif ($server_day == 5) { // Friday
			if ($server_time < $shipping_time && ($shipping_server_diff > 0 ) ) { 
				$date = strtotime("+0 days");
			}
			elseif ($shipping_weekend == 0) {
				$date = strtotime("+1 days"); 
				$shipping_time = "$shipping_sat:$shippingSeconds";
			}
			elseif ($shipping_weekend == 1) {	
				$date = strtotime("+3 days"); 
				$shipping_time = "$shipping_mon:$shippingSeconds";
			}
			$calculated_date = date('Y m d',$date);
		} 
		elseif ($server_day == 6) { // Saturday
		if ($server_time < $shipping_time && ($shipping_server_diff > 0) && ($shipping_weekend == 0)) { 
				$date = strtotime("+2 days");
			}
		elseif ($server_time < $shipping_time && ($shipping_server_diff > 0) && ($shipping_weekend == 1)) { 
				$date = strtotime("+3 days");
			}
		elseif ($shipping_weekend == 1) {
				$date = strtotime("+2 days");
			}
		else {	
				$date = strtotime("+1 day"); 
				$shipping_time ="$shipping_sun:$shippingSeconds";
			}
			$calculated_date = date('Y m d',$date);
		} 

		$shipping_time_diff = strtotime("$calculated_date $shipping_time")-strtotime($server_datetime);
			
		if ($shipping_weekend == 1 && $shipping_server_diff > 86400) {
			$hidetimer = 'hide';
		} else {
			$hidetimer = 'show';
		}
		
		?>
		
			<div class="purely-countdown <?php echo $hidetimer; ?>"></div>
			
		<?php if ($text_after) {
			echo '<p>';
			echo $text_after;
			echo '</p><p>';
		} ?>

		<script>
			var shippingVar = "<?php echo $calculated_date;?> <?php echo $shipping_time; ?>";
        </script>
		
		</div>
			
<?php
	// Close .widget-text 			
		echo '</div>';
		echo $after_widget;
	}
	
}

// register widget
add_action('widgets_init', 'register_purely_shipping_countdown');
function register_purely_shipping_countdown() {
    register_widget('purely_shipping_countdown');
}

?>