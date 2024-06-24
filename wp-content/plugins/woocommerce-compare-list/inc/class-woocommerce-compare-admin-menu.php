<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Woocommerce_Compare_Admin_Menu extends WC_Settings_Page {
	//Methods
	public function __construct() {
		$this->id    = 'compare';
		$this->label = 'Сравнение';

		parent::__construct();
	}

	public function get_sections() {
		$sections = array(
			''             => __( 'General', 'woocommerce' ),
		);

		return apply_filters( 'woocommerce_get_sections_' . $this->id, $sections );
	}

	public function get_settings( $current_section = '' ) {
		if ( '' === $current_section ) {
			$fields = array(
				array(
					'title' => __( 'Page setup', 'woocommerce' ),
					'desc'  => 'Пожалуйста, выберите нужные для Вас настройки',
					'type'  => 'title',
					'id'    => 'compare_page_option',
				),
					array(
						'title'    => 'Страница сравнения',
						'desc'     => '',
						'id'       => 'woocommerce_compare_page_id',
						'type'     => 'single_select_page',
						'default'  => '',
						'class'    => 'wc-enhanced-select-nostd',
						'css'      => 'min-width:300px;',
						'args'     => array(
						'exclude'  =>
							array(
								wc_get_page_id( 'cart' ),
								wc_get_page_id( 'checkout' ),
								wc_get_page_id( 'myaccount' ),
							),
						),
						'desc_tip' => false,
						'autoload' => false,
					),
				array(
					'type' => 'sectionend',
					'id'   => 'compare_page_option',
				),
				array(
					'title' => 'Место вставки кнопки',
					'type'  => 'title',
					'id'    => 'compare_button_position',
				),
					array(
						'title'    => 'Кнопка сравнения в цикле WooCommerce',
						'id'       => 'compare_product_position_in_loop',
						'default'  => 'all',
						'type'     => 'select',
						'class'    => 'wc-enhanced-select',
						'css'      => 'min-width: 300px;',
						'desc_tip' => false,
						'options'  => array(
							'no'                        => 'Нет',
							'before_add_to_cart_button' => 'Перед кнопкой в корзину',
						),
					),
					array(
						'title'    => 'Кнопка сравнения в товаре WooCommerce',
						'id'       => 'compare_product_position_in_product',
						'default'  => 'all',
						'type'     => 'select',
						'class'    => 'wc-enhanced-select',
						'css'      => 'min-width: 300px;',
						'desc_tip' => false,
						'options'  => array(
							'no'                        => 'Нет',
							'near_add_to_cart_button' => 'Рядом с кнопкой добавить в корзину',
						),
					),
				array(
					'type' => 'sectionend',
					'id'   => 'compare_button_position',
				),
				array(
					'title' => 'Вывод цены на странице сравнения',
					'type'  => 'title',
					'id'    => 'compare_show_price_attr',
				),
					array(
						'title'    => 'Показывать цену на странице сравнения?',
						'id'       => 'show_price_compare',
						'default'  => 'all',
						'type'     => 'select',
						'class'    => 'wc-enhanced-select_price',
						'css'      => 'min-width: 300px;',
						'desc_tip' => false,
						'options'  => array(
							'no'    => 'Нет',
							'yes' 	=> 'Да',
						),
					),
				array(
					'type' => 'sectionend',
					'id'   => 'compare_show_price_attr',
				),
				array(
					'title' => 'Вывод уведомления',
					'type'  => 'title',
					'id'    => 'show_moadal_add_remove_product_compare',
				),
					array(
						'title'    => 'Показывать уведомление о добавлении/удалении товара из списка сравнения?',
						'id'       => 'show_compare_modal',
						'default'  => 'all',
						'type'     => 'select',
						'class'    => 'wc-enhanced-select_modal',
						'css'      => 'min-width: 300px;',
						'desc_tip' => false,
						'options'  => array(
							'no'    => 'Нет',
							'yes' 	=> 'Да',
						),
					),
				array(
					'type' => 'sectionend',
					'id'   => 'show_moadal_add_remove_product_compare',
				),
			);
			
			$settings = apply_filters('woocommerce_compare_settings', $fields);
		}

		return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings, $current_section );
	}

	/*
	* Form method.
	*
	* @deprecated 3.4.4
	*
	* @param  string $method Method name.
	*
	* @return string
	*/
	public function form_method( $method ) {
		return 'post';
	}

	/**
	 * Output the settings.
	 */
	public function output() {
		global $current_section;
		$settings = $this->get_settings( $current_section );
		WC_Admin_Settings::output_fields( $settings );
	}

	/**
	 * Save settings.
	 */
	public function save() {
		global $current_section;
		$settings = $this->get_settings( $current_section );
		WC_Admin_Settings::save_fields( $settings );
	}
}

$WoocommerceAdminMenuCompare = new Woocommerce_Compare_Admin_Menu();