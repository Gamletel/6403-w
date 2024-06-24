<?php
/*
* Plugin Name: Сравнение товаров для woocommerce
* Description: Плагин, позволяющий создавать свой список сравнения
* Version: 1.0.0
* Author: grampus
*/

if(!function_exists('add_action')) {
	die();
}

if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) 
{
	class Woocommerce_Compare
	{
		//Methods
		public function __construct()
		{
			add_filter('woocommerce_get_settings_pages', array($this, 'add_woocommerce_settings_page_compare') );
	
			add_action('wp_enqueue_scripts', [$this, 'compare_init_scripts']);
	
			add_action( 'wp_ajax_compare_counter', [$this, 'compare_counter'] );
			add_action( 'wp_ajax_nopriv_compare_counter', [$this, 'compare_counter'] );
	
			add_shortcode('compare-counter-html', [$this, 'compare_counter_html']);

			add_filter( 'display_post_states', [$this, 'register_post_states'], 10, 2);
			add_filter( 'template_include',  [$this, 'compare_list_plugin_template']);

			if(get_option('compare_product_position_in_loop') == 'before_add_to_cart_button') 
			{
				add_action('woocommerce_after_shop_loop_item', [$this, 'compare_create_button_loop']);
			}

			if(get_option('compare_product_position_in_product') == 'near_add_to_cart_button') 
			{
				add_action('woocommerce_single_product_summary', [$this, 'compare_create_button_single'], 35);
			}

			if(get_option('show_compare_modal') == 'yes') 
			{
				add_action( 'wp_ajax_add_modal_compare', [$this, 'add_modal_compare'] );
				add_action( 'wp_ajax_nopriv_add_modal_compare', [$this, 'add_modal_compare'] );
				add_action('wp_footer', [$this, 'add_modal_compare_html']);
			}			
		}
		
		//Enqueue style and scripts
		public function compare_init_scripts()
		{
			wp_enqueue_script('cookie-jquery', plugins_url( '/assets/js/jquery.cookie.js', __FILE__ ), array('jquery'), true );
			wp_enqueue_script('script-compare.js', plugins_url( '/assets/js/script-compare.js', __FILE__ ), array('jquery'), true );
			
			wp_enqueue_style('main-compare', plugins_url( '/assets/css/main.css', __FILE__ ), false );
		}
		
		//Array compare products
		public function compare_items()
		{	
			if(isset($_COOKIE['woocommerce-compare'])) {
				$list = $_COOKIE['woocommerce-compare'];
				return json_decode(stripslashes($list), true);
			}else{
				$list = [];
				return $list;
			}
			
		}

		//Create Button in loop
		public function compare_create_button_loop() 
		{
			wc_get_template('loop/add-to-compare-loop.php', array(), '', WP_PLUGIN_DIR . '/woocommerce-compare-list/templates/');
		}

		//Create Button in single-product
		public function compare_create_button_single() 
		{
			wc_get_template('single-product/add-to-compare-single.php', array(), '', WP_PLUGIN_DIR . '/woocommerce-compare-list/templates/');
		}
	
		//Function update counter
		public function compare_counter() 
		{
			$count = $_POST['count'];
			echo $count;
			wp_die();
		}
	
		//Function shortcode counter
		public function compare_counter_html()
		{
			$favorite_list = count($this->compare_items()) ?: 0;
			echo '<span id="compare-count">' . $favorite_list . '</span>';
		}
	
		//Function add admin settings
		public function add_woocommerce_settings_page_compare($settings)
		{
			$settings[] = include 'inc/class-woocommerce-compare-admin-menu.php';
			return $settings;
		}

		//Function check item in array
		public function compare_check_item($product_id)
		{
			$key = array_search($product_id, $this->compare_items());
			if($key !== false)
			{
				return true;
			}
			return false;
		}

		//Function add page label in admin menu 
		public function register_post_states($post_states, $post)
		{
			$compare_id = wc_get_page_id('compare');
			if($post->ID == $compare_id)
			{
				$post_states['compare'] = 'Страница сравнения';
			}
			return $post_states;
		}

		//Function template page 
		public function compare_list_plugin_template($template)
		{
			global $post;
			$compare_id = wc_get_page_id('compare');
			if($post !== null) {
				if ( $post->ID == $compare_id && $post->ID !== null ) {
					$template = wp_normalize_path( WP_PLUGIN_DIR . '/woocommerce-compare-list/templates/compare-page/compare-page.php' );
				}
				$template_name = 'compare-page/compare-page.php';
				$_template = wc_locate_template($template_name);
				
				if(file_exists($_template) == true && $post->ID == $compare_id) {
					$template = $_template;
				}
			}

			return $template;
		}

		//Function get URL compare page
		public function get_compare_page_url()
		{
			$compare_id = wc_get_page_id('compare');
			$link_page = get_page_link($compare_id);
			return $link_page;
		}

		//Function get all atrributes products in compare list
		public function get_attr_products_in_compare()
		{
			$CompareItems = $this->compare_items();
			$array_attr_product = [];
			$key = [];
			$value = [];
		
			foreach ($CompareItems as $CompareItem) {
				$_c_product = wc_get_product($CompareItem);
				$_c_product_attrs = $_c_product->get_attributes();
		
				foreach ($_c_product_attrs as $_c_product_attr) {
					array_push($key, $_c_product_attr['id']);
					array_push($value, $_c_product_attr['name']);
				}
			}
		
			$array_attr_product = array_combine($key, $value);
			
			return $array_attr_product;
		}

		//Function add modal
		function add_modal_compare()
		{	
			echo '<div id="compare-modal"></div>';
			wp_die();
		}
		function add_modal_compare_html() {
			echo '<div id="compare-modal"></div>';
		}
	}
	$WoocommerceCompare = new Woocommerce_Compare();
}
