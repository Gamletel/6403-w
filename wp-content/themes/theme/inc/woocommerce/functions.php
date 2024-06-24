<?php

class WooThemeFunctions
{
    /*
     * WC GLOBAL
     */
    function change_existing_currency_symbol($currency_symbol, $currency)
    {
        switch ($currency) {
            case 'RUB':
                $currency_symbol = 'руб';
                break;
        }
        return $currency_symbol;
    }

    public function error_fade_out()
    {
        // если находимся не на странице оформления заказа, то ничего не делаем
        if (!is_checkout()) {
            return;
        }

        wc_enqueue_js("
		$( document.body ).on( 'checkout_error', function(){
			setTimeout( function(){
				$('.woocommerce-error').fadeOut( 300 );
			}, 2000);
		})
	");
    }

    public function wc_refresh_mini_cart_count($fragments)
    {
        ob_start();
        $products_count = WC()->cart->get_cart_contents_count();
        if ($products_count > 99) {
            $products_count = '99+';
        }
        ?>
        <div id="cart-count">
            <?php echo $products_count; ?>
        </div>
        <?php
        $fragments['#cart-count'] = ob_get_clean();
        return $fragments;
    }

    public function woo_custom_cart_button_text()
    {
        return __('ДОБАВИТЬ В КОРЗИНУ', 'woocommerce');
    }

    function custom_sale_price($price, $product)
    {
        if ($product->is_on_sale()) {
            $sale_price = $product->get_sale_price();
            $regular_price = $product->get_regular_price();
            return '
<div class="product-price">
    <div class="price">
        <div class="sale-price main-price">' . $sale_price . '</div>
        
        <div class="regular-price additional-price">' . $regular_price . '</div>
    </div>
    руб/шт
</div>';
        } else {
            $regular_price = $product->get_regular_price();
            return '
<div class="product-price">
    <div class="price">
        <div class="regular-price main-price">' . $regular_price . '</div>
    </div>
    руб/шт
</div>';
        }

        return $price;
    }


    function custom_variable_product_price($price, $product)
    {
        $prices = $product->get_variation_prices('min', true);
        $maxprices = $product->get_variation_price('max', true);
        $min_price = current($prices['price']);
        //$max_price = current( $maxprices['price'] );
        $minPrice = sprintf(__('От %1$s <br>', 'woocommerce'), wc_price($min_price));
        $maxPrice = sprintf(__('до %1$s', 'woocommerce'), wc_price($maxprices));
        return $minPrice . ' ' . $maxPrice;
    }

    public function custom_breadcrumbs()
    {
        ?>
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>
        </div>
    <?php }

    public function register_my_widgets()
    {
        register_sidebar(
            array(
                'name' => 'Фильтр товаров',
                'id' => "sidebar-shop",
                'description' => '',
                'class' => '',
                'before_sidebar' => '',
                'after_sidebar' => '',
            )
        );
    }

    /*
     * CATEGORY-CARD
     */

    public function remove_count()
    {
        $html = '';
        return $html;
    }

    public function add_category_background()
    {
        inline('assets/images/category-bg.svg');
    }

    public function category_image_wrapper($category)
    {
        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
        $image = wp_get_attachment_image_src($thumbnail_id, 'full');
        $image = $image[0];
        $image = str_replace(' ', '%20', $image);
        ?>
        <div class="image-wrapper">
            <img src="<?= esc_url($image); ?>" alt="">
        </div>
        <?php
    }

    public function open_category_content_wrapper()
    {
        ?>
        <div class="category-content">
    <?php }

    public function category_link($category)
    {
        $link = get_category_link($category);
        $terms = get_terms('product_cat', [
            'hide_empty' => false,
            'parent' => $category->term_id,
        ]);
        ?>

        <?php if (!$terms && !is_product_category()) { ?>
        <a href="<?= $link; ?>" class="link">
            Подробнее

            <?= inline('assets/images/arrow.svg'); ?>
        </a>
    <?php } else if (is_product_category()) { ?>
        <div class="link">
            Подробнее

            <?= inline('assets/images/arrow.svg'); ?>
        </div>

        <div class="subcats">
            <div class="container">
                <div class="close-subcats">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <g clip-path="url(#clip0_528_41776)">
                            <path d="M11.0518 0L7 4.05177L2.94823 0L0 2.94823L4.0518 7L0 11.0518L2.9482 14L7 9.9482L11.0518 14L14 11.0518L9.9482 6.99997L14 2.9482L11.0518 0Z"
                                  fill="#C9CCCE"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_528_41776">
                                <rect width="14" height="14" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>

                <div class="subcats__wrapper">
                    <?php foreach ($terms as $item) {
                        $link = get_term_link($item);
                        $title = $item->name;
                        $thumbnail_id = get_term_meta($item->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_image_src($thumbnail_id, 'full');
                        $image = $image[0];
                        $image = str_replace(' ', '%20', $image);
                        ?>
                        <a href="<?= $link; ?>" class="subcat">
                            <?php if ($image) { ?>
                                <img src="<?= esc_url($image); ?>" alt="" class="subcat__thumbnail">
                            <?php } ?>

                            <?php if ($title) { ?>
                                <span class="p2 subcat__title">
                                    <?= $title; ?>
                                </span>
                            <?php } ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <a href="<?= $link; ?>" class="link">
            Подробнее

            <?= inline('assets/images/arrow.svg'); ?>
        </a>
    <?php }
    }

    public function close_category_content_wrapper()
    {
        ?>
        </div>
    <?php }

    public function custom_category_top_part($category)
    {
        $shortDescription = get_field('s-description', $category);
        ?>
        <div class="category-top">
            <h4 class="woocommerce-loop-category__title">
                <?php
                echo esc_html($category->name);
                if ($category->count > 0) {
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html($category->count) . ')</mark>', $category);
                }
                ?>
            </h4>

            <div class="btn-main disabled-color">
                Подробнее
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L16 12L9 19" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>
            <?php
            if ($shortDescription) { ?>
                <div class="short-descr">
                    <?php echo $shortDescription; ?>
                </div>
                <?php
            } ?>
        </div>
        <?php
    }

    /*
     * ARCHIVE-PRODUCT
     */
    public function products_per_page($cols)
    {
        return 9;
    }

    public function archive_category_banner()
    {
        if (!is_shop()) {
            $query_id = get_queried_object_id();
            $term = get_term($query_id);
            $title = $term->name;
            $changed_title = get_field('changed_title', $term);
            $advantages = get_field('advantages', $term);
            $archive_image = wp_get_attachment_image_url(get_field('archive_image', $term), 'full');
            $subcategories = get_terms(array(
                'hide_empty' => false,
                'taxonomy' => 'product_cat',
                'parent' => $query_id,
            ));
            ?>
            <div class="header__main-banner block-margin">
                <div class="main-banner__text">
                    <h1 class="main-banner__title page-title">
                        <?php if ($changed_title) {
                            echo $changed_title;
                        } else {
                            echo $title;
                        } ?>
                    </h1>

                    <?php if ($advantages) { ?>
                        <div class="advantages">
                            <?php foreach ($advantages as $advantage) {
                                $text = $advantage['text'];
                                ?>
                                <div class="advantage">
                                    <div class="advantage__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path d="M16.2806 9.21937C16.3504 9.28903 16.4057 9.37175 16.4434 9.46279C16.4812 9.55384 16.5006 9.65144 16.5006 9.75C16.5006 9.84856 16.4812 9.94616 16.4434 10.0372C16.4057 10.1283 16.3504 10.211 16.2806 10.2806L11.0306 15.5306C10.961 15.6004 10.8783 15.6557 10.7872 15.6934C10.6962 15.7312 10.5986 15.7506 10.5 15.7506C10.4014 15.7506 10.3038 15.7312 10.2128 15.6934C10.1218 15.6557 10.039 15.6004 9.96938 15.5306L7.71938 13.2806C7.57865 13.1399 7.49959 12.949 7.49959 12.75C7.49959 12.551 7.57865 12.3601 7.71938 12.2194C7.86011 12.0786 8.05098 11.9996 8.25 11.9996C8.44903 11.9996 8.6399 12.0786 8.78063 12.2194L10.5 13.9397L15.2194 9.21937C15.289 9.14964 15.3718 9.09432 15.4628 9.05658C15.5538 9.01884 15.6514 8.99941 15.75 8.99941C15.8486 8.99941 15.9462 9.01884 16.0372 9.05658C16.1283 9.09432 16.211 9.14964 16.2806 9.21937ZM21.75 12C21.75 13.9284 21.1782 15.8134 20.1068 17.4168C19.0355 19.0202 17.5127 20.2699 15.7312 21.0078C13.9496 21.7458 11.9892 21.9389 10.0979 21.5627C8.20656 21.1865 6.46928 20.2579 5.10571 18.8943C3.74215 17.5307 2.81355 15.7934 2.43735 13.9021C2.06114 12.0108 2.25422 10.0504 2.99218 8.26884C3.73013 6.48726 4.97982 4.96451 6.58319 3.89317C8.18657 2.82183 10.0716 2.25 12 2.25C14.585 2.25273 17.0634 3.28084 18.8913 5.10872C20.7192 6.93661 21.7473 9.41498 21.75 12ZM20.25 12C20.25 10.3683 19.7661 8.77325 18.8596 7.41655C17.9531 6.05984 16.6646 5.00242 15.1571 4.37799C13.6497 3.75357 11.9909 3.59019 10.3905 3.90852C8.79017 4.22685 7.32016 5.01259 6.16637 6.16637C5.01259 7.32015 4.22685 8.79016 3.90853 10.3905C3.5902 11.9908 3.75358 13.6496 4.378 15.1571C5.00242 16.6646 6.05984 17.9531 7.41655 18.8596C8.77326 19.7661 10.3683 20.25 12 20.25C14.1873 20.2475 16.2843 19.3775 17.8309 17.8309C19.3775 16.2843 20.2475 14.1873 20.25 12Z"
                                                  fill="var(--primary)"/>
                                        </svg>
                                    </div>

                                    <div class="advantage__text p1">
                                        <?= $text; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                <?php if ($archive_image) { ?>
                    <img src="<?= $archive_image; ?>" class="main-banner__image" alt="">
                <?php } ?>
            </div>

            <?php if (!empty($subcategories)) { ?>
                <div class="header__subcategories block-margin">
                    <div class="container">
                        <div class="header__subcategories-wrapper">
                            <?php foreach ($subcategories as $item) {
                                $link = get_term_link($item);
                                $name = $item->name;
                                ?>
                                <a href="<?= $link; ?>" class="subcategory tab">
                                    <?= $name; ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php
        }
    }

    public function archive_advantages()
    {
        if (!is_shop()) {
            $archive_advantages = theme('archive_advantages');

            get_template_part('inc/blocks/advantages-block/render',
                null,
                array('hasBG' => $archive_advantages['hasBG'],
                    'advantages' => $archive_advantages['advantages'],
                ));
            wp_enqueue_style('advantages-block', get_template_directory_uri() . '/inc/blocks/advantages-block/block.css', array(), 2);
            wp_enqueue_script('advantages-block', get_template_directory_uri() . '/inc/blocks/advantages-block/block.js', array(), 2);
        }
    }

    public function archive_subcategories()
    {
        if (!is_shop()) {
            $query_id = get_queried_object_id();
            $term = get_term($query_id);
            $terms = get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => $query_id,
                'hide_empty' => false,
            ));

            get_template_part('inc/blocks/categories-block/render',
                null,
                array('terms' => $terms,
                ));
            wp_enqueue_style('categories-block', get_template_directory_uri() . '/inc/blocks/categories-block/block.css', array(), 2);
            wp_enqueue_script('categories-block', get_template_directory_uri() . '/inc/blocks/categories-block/block.js', array(), 2);
        }
    }

    public function archive_products_title()
    {
        echo '<div class="container">
                <h1 class="page-title">
                    Каталог
                </h1>
              </div>';
    }

    public function archive_products_advantages()
    {
        $archive_products_advantages = theme('archive_products_advantages');
        if (is_product_category()) {
            ?>

            <div class="container">
                <?php get_template_part('inc/blocks/advantages-v2-block/render',
                    null,
                    array('advantages' => $archive_products_advantages['advantages'],
                        'image_1' => $archive_products_advantages['image_1'],
                        'image_2' => $archive_products_advantages['image_2'],
                    ));
                wp_enqueue_style('advantages-v2-block', get_template_directory_uri() . '/inc/blocks/advantages-v2-block/block.css', array(), 2);
                wp_enqueue_script('advantages-v2-block', get_template_directory_uri() . '/inc/blocks/advantages-v2-block/block.js', array(), 2);
                ?>
            </div>
            <?php
        }
    }

    public function archive_products_additional_blocks()
    {
        ?>
        <div class="catalog__additional-blocks">
            <div class="container">
                <?php
                if (is_product_category() || is_product()) {
                    $footer_slider = theme('footer_slider');
                    get_template_part('inc/blocks/slider-block/render',
                        null,
                        array(
                            'block_title' => $footer_slider['block_title'],
                            'slides' => $footer_slider['slides'],
                        ));
                    wp_enqueue_style('slider-block', get_template_directory_uri() . '/inc/blocks/slider-block/block.css', array(), 2);
                    wp_enqueue_script('slider-block', get_template_directory_uri() . '/inc/blocks/slider-block/block.js', array(), 2);

                    if (is_product_category()) {
                        $footer_brands = theme('footer_brands');
                        get_template_part('inc/blocks/brands-block/render',
                            null,
                            array(
                                'block_title' => $footer_brands['block_title'],
                                'show_all' => $footer_brands['show_all'],
                            ));
                        wp_enqueue_style('brands-block', get_template_directory_uri() . '/inc/blocks/brands-block/block.css', array(), 2);
                        wp_enqueue_script('brands-block', get_template_directory_uri() . '/inc/blocks/brands-block/block.js', array(), 2);

                        $footer_text_block = theme('footer_text_block');
                        get_template_part('inc/blocks/text-block/render',
                            null,
                            array(
                                'block_title' => $footer_text_block['block_title'],
                                'text' => $footer_text_block['text'],
                                'image' => $footer_text_block['image'],
                            ));
                        wp_enqueue_style('text-block', get_template_directory_uri() . '/inc/blocks/text-block/block.css', array(), 2);
                        wp_enqueue_script('text-block', get_template_directory_uri() . '/inc/blocks/text-block/block.js', array(), 2);
                    }
                }
                ?>
            </div>
        </div>
        <?php
    }

    /*
     * PRODUCT-CARD
     */
    public function open_product_card_top_part()
    { ?>
        <div class="product-card__top">
    <?php }

    public function product_card_tags()
    {
        global $product;
        $terms = get_terms([
            'taxonomy' => 'product_tag',
            'include' => $product->get_tag_ids()
        ]);
        ?>
        <?php if ($terms) { ?>
        <div class="product-card__tags tags">
            <?php foreach ($terms as $term) {
                $name = $term->name;
                ?>
                <div class="tag"><?= $name; ?></div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php }

    public function close_product_card_top_part()
    { ?>
        </div>
    <?php }

    public function product_card_top_part()
    {
        global $product;
        $tags = $product->tag_ids;
        $sku = $product->get_sku();
        $thumbnail = woocommerce_get_product_thumbnail('full');
        ?>
        <?php if ($tags) { ?>
        <div class="product-card__tags tags">
            <?php foreach ($tags as $tag) {
                $term = get_term($tag);
                $name = $term->name;
                $color_for = get_field('color_for', $term);
                $color = get_field('color', $term);
                switch ($color_for) {
                    case 'text':
                        $tag_style = 'style="background-color:var(--card);border: 1px solid ' . $color . ';color: ' . $color . ';"';
                        break;
                    case 'bg':
                        $tag_style = 'style="background-color:' . $color . ';color: var(--card);"';
                        break;
                }
                ?>
                <div class="tag" <?= $tag_style; ?>>
                    <?= $name; ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

        <div class="product-card__thumbnail">
            <?= $thumbnail; ?>
        </div>

        <?php if ($sku) { ?>
        <div class="product-card__sku p3">
            <?= $sku; ?>
        </div>
    <?php } ?>
        <?php
    }

    public function product_card_bottom_part()
    {
        global $product;
        global $WoocommerceCompare;
        $product_id = $product->get_id();
        $short_description = $product->get_short_description();
        $product_card_attributes = get_field('product_card_attributes', $product->get_id());
        ?>
        <div class="product-card__bottom">
            <?php woocommerce_template_loop_product_title(); ?>

            <?php if ($short_description) { ?>
                <div class="product-card__short-description">
                    <?= $short_description; ?>
                </div>
            <?php } ?>

            <?php if ($product_card_attributes) { ?>
                <div class="product-card__attributes">
                    <?php foreach ($product_card_attributes as $item) {
                        $card_attribute_id = $item['attribut'];
                        $card_attribute = wc_get_attribute($card_attribute_id);
                        $card_attribute_slug = $card_attribute->slug;
                        $card_attribute_name = $card_attribute->name;
                        $card_attribute_value = $product->get_attribute($card_attribute_slug);
                        ?>
                        <div class="attribute">
                            <div class="attribute__title p3"><?= $card_attribute_name; ?></div>

                            <div class="decor"></div>

                            <h6 class="attribute__value"><?= $card_attribute_value; ?></h6>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="product-card__price">
                <h5 class="price">
                    <?= $product->get_price(); ?> руб
                </h5>

                <div class="btns">
                    <?= woocommerce_template_loop_add_to_cart(); ?>

                    <button value="<?php echo $product_id; ?>"
                            class="compare-button <?php if ($WoocommerceCompare->compare_check_item($product_id) == true) { ?>added<?php } ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M6 18L6 9" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M6 5L6 2" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M14 11L14 2" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M14 18V15" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <circle cx="14" cy="13" r="2" transform="rotate(-90 14 13)" stroke="var(--primary)"
                                    stroke-width="1.5"/>
                            <circle cx="6" cy="7" r="2" transform="rotate(-90 6 7)" stroke="var(--primary)"
                                    stroke-width="1.5"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    <?php }

    public function product_card_additional_blocks()
    {
        global $product;
        $related_products = wc_get_related_products($product->get_id(), 10);

        get_template_part('inc/blocks/products-block/render',
            null,
            array('block_title' => 'Похожие товары',
                'products' => $related_products,
            ));
        wp_enqueue_style('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.css', array(), 2);
        wp_enqueue_script('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.js', array(), 2);


        $block_title = isset($args['block_title']) ? $args['block_title'] : get_field('block_title');
    }

    public function show_additional_blocks()
    {
        $footer_sales_block = theme('footer_sales_block');
        get_template_part('inc/blocks/sales-block/render',
            null,
            array('block_additional' => $footer_sales_block['block_additional'],
                'block_title' => $footer_sales_block['block_title'],
                'btn_text' => $footer_sales_block['btn_text'],
                'sales' => $footer_sales_block['sales'],
                'image' => $footer_sales_block['image'],
            ));
        wp_enqueue_style('sales-block', get_template_directory_uri() . '/inc/blocks/sales-block/block.css', array(), 2);
        wp_enqueue_script('sales-block', get_template_directory_uri() . '/inc/blocks/sales-block/block.js', array(), 2);


        $footer_employees_block = theme('footer_employees_block');
        get_template_part('inc/blocks/employees-block/render',
            null,
            array('block_title' => $footer_employees_block['block_title'],
                'show_all' => $footer_employees_block['show_all'],
                'employees' => $footer_employees_block['employees'],
            ));
        wp_enqueue_style('employees-block', get_template_directory_uri() . '/inc/blocks/employees-block/block.css', array(), 2);
        wp_enqueue_script('employees-block', get_template_directory_uri() . '/inc/blocks/employees-block/block.js', array(), 2);


        $footer_form_block = theme('footer_form_block');
        get_template_part('inc/blocks/form-block/render',
            null,
            array('block_title' => $footer_form_block['block_title'],
                'image' => $footer_form_block['image'],
            ));
        wp_enqueue_style('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.css', array(), 2);
        wp_enqueue_script('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.js', array(), 2);


        $footer_advantages_block = theme('footer_advantages_block');
        get_template_part('inc/blocks/advantages-block/render',
            null,
            array('block_title' => $footer_advantages_block['block_title'],
                'advantages' => $footer_advantages_block['advantages'],
            ));
        wp_enqueue_style('advantages-block', get_template_directory_uri() . '/inc/blocks/advantages-block/block.css', array(), 2);
        wp_enqueue_script('advantages-block', get_template_directory_uri() . '/inc/blocks/advantages-block/block.js', array(), 2);


        $footer_certificates_block = theme('footer_certificates_block');
        get_template_part('inc/blocks/certificates-block/render',
            null,
            array('block_title' => $footer_certificates_block['block_title'],
                'show_all' => $footer_certificates_block['show_all'],
                'numberposts' => $footer_certificates_block['numberposts'],
                'certificates' => $footer_certificates_block['certificates'],
            ));
        wp_enqueue_style('certificates-block', get_template_directory_uri() . '/inc/blocks/certificates-block/block.css', array(), 2);
        wp_enqueue_script('certificates-block', get_template_directory_uri() . '/inc/blocks/certificates-block/block.js', array(), 2);

    }

    /*
     * PRODUCT-PAGE
     */
    public function show_custom_title()
    {
        global $product;
        echo '<h1 class="page-title">' . get_the_title($product->get_id()) . '</h1>';
    }

    public function custom_product_swiper()
    {
        global $product;

        $video = get_field('video', $product->get_id());
        $thumbnail = wp_get_attachment_image($product->get_image(), 'full');
        $images = $product->get_gallery_image_ids();
        ?>

        <div class="single-product__gallery">
            <div class="swiper product-main-swiper">
                <div class="swiper-wrapper">
                    <?php if ($thumbnail) { ?>
                        <div class="swiper-slide">
                            <div class="image" data-fancybox='gallery' data-src='<?= $thumbnail; ?>'>
                                <img src="<?= $thumbnail; ?>" alt="">
                            </div>
                        </div>
                    <?php } ?>

                    <?php foreach ($images as $image) {
                        $image_url = wp_get_attachment_image_url($image, 'full');
                        ?>
                        <div class="swiper-slide">
                            <div class="image" data-fancybox='gallery' data-src='<?= $image_url; ?>'>
                                <img src="<?= $image_url; ?>" alt="">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="product-thumbs-swiper">
                <div class="swiper-btn-mini-prev">
                    <?= inline('assets/images/swiper-mini-btn.svg'); ?>
                </div>

                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php if ($thumbnail) { ?>
                            <div class="swiper-slide">
                                <div class="image">
                                    <img src="<?= $thumbnail; ?>" alt="">
                                </div>
                            </div>
                        <?php } ?>

                        <?php foreach ($images as $image) {
                            $image_url = wp_get_attachment_image_url($image, 'full');
                            ?>
                            <div class="swiper-slide">
                                <div class="image">
                                    <img src="<?= $image_url; ?>" alt="">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="swiper-btn-mini-next">
                    <?= inline('assets/images/swiper-mini-btn.svg'); ?>
                </div>
            </div>
            <?php /* if ($video) {
                $image = wp_get_attachment_image_url($video['image'], 'full');
                $link = $video['link'];
                ?>
                <div class="video" data-fancybox data-src='http://www.youtube.com/embed/<?= $link; ?>'>
                    <img src="<?= $image; ?>" alt="">

                    <div class="play">
                        <?= inline('assets/images/play.svg'); ?>
                    </div>
                </div>
            <?php }  */ ?>
        </div>
        <?php
    }

    public function open_product_main_info()
    { ?>
        <div class="single-product__main-info">
    <?php }

    public function close_product_main_info()
    {
        ?>
        </div>
    <?php }

    public function product_info()
    {
        global $product;

        $main_attributes = get_field('main_attributes', $product->get_id());

        ?>
        <div class="single-product__info">
            <?php if ($main_attributes) { ?>
                <div class="single-product__attributes">
                    <?php foreach ($main_attributes as $item) {
                        $main_attribute_id = $item['attribut'];
                        $main_attribute = wc_get_attribute($main_attribute_id);
                        $main_attribute_slug = $main_attribute->slug;
                        $main_attribute_name = $main_attribute->name;
                        $main_attribute_value = $product->get_attribute($main_attribute_slug);
                        ?>
                        <div class="attribute">
                            <h6 class="attribute__title"><?= $main_attribute_name; ?></h6>

                            <div class="p2 attribute__value"><?= $main_attribute_value; ?></div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="single-product__info-bottom">
                <div class="single-product__price">
                    <h6 class="price__title">
                        Оптовая цена
                    </h6>

                    <?= $product->get_price_html() ?>
                </div>

                <div class="single-product__btns">
                    <?= woocommerce_template_single_add_to_cart(); ?>
                </div>
            </div>
        </div>
        <?php
    }

    public function top_row()
    {
        global $product;
        $terms = get_terms([
            'taxonomy' => 'product_tag',
            'include' => $product->get_tag_ids()
        ]);
        ?>
        <div class="top-row">
            <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
                <span class="sku_wrapper p3"><?php esc_html_e('SKU:', 'woocommerce'); ?> <span
                            class="sku p3"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></span></span>
            <?php endif; ?>

            <?php if ($terms) { ?>
                <div class="tags">
                    <?php foreach ($terms as $term) {
                        $name = $term->name;
                        ?>
                        <div class="tag"><?= $name; ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php }

    public function additional_attributes()
    {
        global $product;
        $additional_attributes = get_field('additional_attributes', $product->get_id());
        if ($additional_attributes) { ?>
            <div class="additional-attributes">
                <?php foreach ($additional_attributes as $item) {
                    $icon = wp_get_attachment_image_url($item['icon'], 'full');
                    $value = $item['value'];
                    ?>
                    <div class="additional-attribute">
                        <?php if ($icon) { ?>
                            <img src="<?= $icon; ?>" alt="" class="style-svg">
                        <?php } ?>

                        <?php if ($value) { ?>
                            <div class="p2"><?= $value; ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
    }

    public function show_additional_options()
    {
        global $product;
        $additional_options = get_field('additional_options', $product->get_id());
        if ($additional_options) { ?>
            <div class="additional-options">
                <div class="p2 additional-options__title">Дополнительные опции</div>

                <div class="additional-options__wrapper">
                    <?php foreach ($additional_options as $key => $option) {
                        $name = $option['name'];
                        ?>
                        <div class="additional-option">
                            <input type="checkbox" name="additional-option" id="additional-option-<?= $key; ?>"
                                   class="additional-option__checkbox">

                            <label class="p2 additional-option__title"
                                   for="additional-option-<?= $key; ?>">
                                <div class="additional-option__checkbox-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="7" viewBox="0 0 9 7"
                                         fill="none">
                                        <path d="M1 3.50002L3.33348 6L8 1" stroke="#34A0E1" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <?= $name; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php }

    public function show_variation_title()
    {
        echo '<div class="p2 variation-price-title">Стоимость</div>';
    }

    public function woocommerce_custom_single_add_to_cart_text()
    {
        return __('Добавить в корзину', 'woocommerce');
    }

    public function add_to_favorite_btn()
    {
        global $product;
        $in_favorites = WCFAVORITES()->check_item($product->get_id());
        $text = get_option('favorites_category_product_text', 'В избранные');
        ?>

        <button type="button" data-product_id="<?= $product->get_id() ?>"
                class="favorites ajax_add_to_favorites <?php if ($in_favorites) {
                    echo 'added';
                } ?>" aria-label="<?= $text ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M12 8.19444C10 3.5 3 4 3 10C3 16.0001 12 21 12 21C12 21 21 16.0001 21 10C21 4 14 3.5 12 8.19444Z"
                      stroke="#262D31" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    <?php }

    public function product_bottom_block()
    {
        global $product;
        $attributes = $product->get_attributes();
        $description = $product->get_description();
        $full_description = get_field('full_description', $product->get_id());
        ?>
        <?php if ($description || $attributes || $full_description) { ?>

    <?php } ?>
        <div class="single-product__bottom-block block-margin">
            <div class="tabs">
                <?php if ($description || $full_description) { ?>
                    <div class="tab <?php if ($attributes) {
                        echo 'active';
                    } ?>" data-tab="description">Описание
                    </div>
                <?php } ?>

                <?php if ($attributes) { ?>
                    <div class="tab" data-tab="attributes">Характеристики</div>
                <?php } ?>
            </div>

            <div class="content">
                <?php if ($description || $full_description) { ?>
                    <div class="description tab-block" data-tab="description">
                        <?php if ($description) { ?>
                            <div class="p2 text-block"><?= $description; ?></div>
                        <?php } ?>

                        <?php if (!empty($full_description)) {
                            $text = $full_description['text'];
                            $image = wp_get_attachment_image_url($full_description['image'], 'full');
                            ?>
                            <div class="full-description">
                                <?php if ($text) { ?>
                                    <div class="text-block p2"><?= $text; ?></div>
                                <?php } ?>

                                <?php if ($image) { ?>
                                    <div class="full-description__image">
                                        <img src="<?= $image; ?>" alt="">
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ($attributes) { ?>
                    <div class="characteristics tab-block" data-tab="attributes" <?php if ($description) { ?>
                        style="display: none;"
                    <?php } ?>>
                        <?= wc_display_product_attributes($product); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }

    public function product_additional_blocks()
    {
        global $product;
        $related_products = wc_get_related_products($product->get_id(), 7);
        ?>
        <div class="container">
            <div class="product__additional-blocks">
                <?php
                get_template_part('inc/blocks/products-block/render',
                    null,
                    array('block_title' => 'Похожие товары',
                        'products' => $related_products,
                    ));
                wp_enqueue_style('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.css', array(), 2);
                wp_enqueue_script('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.js', array(), 2);
                ?>
            </div>
        </div>
    <?php }

    public function if_product_not_stock()
    {
        global $product;

        if ($product->get_price() == '') {
            echo '<p class="stock out-of-stock">Товар отсутсвует</p>';
        }
    }

    public function jk_related_products_args($args)
    {
        $args['posts_per_page'] = 5; // количество "Похожих товаров"
        return $args;
    }

    /*
     * PAGE-CART
     */
    public function custom_cart_item_price($price, $values, $cart_item_key)
    {

        $is_on_sale = $values['data']->is_on_sale();
        $_product = $values['data'];
        $regular_price = $_product->get_regular_price();

        if ($is_on_sale) {
            $sale_price = $_product->get_sale_price();
            $price = '
<div class="product-price">
    <h4 class="sale-price">' . wc_price($sale_price) . '</h4>
    
    <div class="regular-price">' . wc_price($regular_price) . '</div>
</div>';
        } else {
            $price = '
<div class="product-price">
<h4 class="main-price">' . wc_price($regular_price) . '</h4>
</div>';
        }

        return $price;
    }

    public function cart_products_amount()
    {
        ?>
        <div class="cart-count">
            <div class="p1 count__title">Товаров <br> в корзине</div>

            <h5 class="count__number"><?= WC()->cart->get_cart_contents_count() ?> шт</h5>
        </div>
        <?php
    }

    public function filter_woocommerce_cart_subtotal($subtotal, $compound, $cart)
    {
        $subtotal = 0;
        foreach (WC()->cart->get_cart() as $key => $cart_item) {
            $subtotal += $cart_item['data']->get_regular_price() * $cart_item['quantity'];
        }
        $subtotal = wc_price($subtotal);
        return $subtotal;
    }

    public function print_cart_weight()
    {
        ?>
        <tr class="order-weight">
            <th class="p1">Общая масса</th>

            <td data-title="Масса"><?= WC()->cart->get_cart_contents_weight(); ?> кг</td>
        </tr>
        <?php
    }

    public function print_cart_volume()
    {
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();
        $totalVolume = 0;

        foreach ($items as $item => $values) {
            $_product = wc_get_product($values['data']->get_id());
            $volume = get_field('volume', $_product->get_id());
            $quantity = $values['quantity'];
            if ($volume) {
                $totalVolume += $volume * $quantity;
            }
        }
        ?>
        <tr class="order-volume">
            <th class="p1">Объем</th>

            <td data-title="Масса"><?= $totalVolume; ?> м <sup class="number">3</sup>
            </td>
        </tr>
        <?php
    }

    public function custom_woocommerce_empty_cart_action()
    {
        if (isset($_GET['empty_cart']) && 'yes' === esc_html($_GET['empty_cart'])) {
            WC()->cart->empty_cart();

            $referer = wp_get_referer() ? esc_url(remove_query_arg('empty_cart')) : wc_get_cart_url();
            wp_safe_redirect($referer);
        }
    }

    public function custom_woocommerce_empty_cart_button()
    {
        echo '<a href="' . esc_url(add_query_arg('empty_cart', 'yes')) . '" class="clear-cart" title="' . esc_attr('Empty Cart', 'woocommerce') . '">
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
  <path d="M7.5 7L17.5 17M7.5 17L17.5 7" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
<h6>
Очистить корзину
</h6>
</a>';
    }

    /*
     * PAGE-CHECKOUT
     */
    public function carrie_customer_default_shipping_country($value, $customer)
    {
        $value = !empty($value) ? $value : 'RU';
        return $value;
    }

    public function custom_override_checkout_fields($fields)
    {
        unset($fields['billing']['billing_country']); // Отключаем страны оплаты
        unset($fields['shipping']['shipping_country']);// Отключаем страны доставки
        return $fields;
    }

    public function custom_thankyou_text($order, $permission)
    {
        $order = 'Заказ успешно оформлен!';

        return $order;
    }

    public function custom_checkout_order_review()
    {
        ?>
        <div class="cart-count">
            <div class="p1 count__title">Товаров <br> в корзине</div>

            <h5 class="count__number"><?= WC()->cart->get_cart_contents_count() ?> шт</h5>
        </div>
        <?php
    }

    public function open_additional_field_block()
    {
        ?>
        <div class="additional-section__wrapper">
        <h3>Адрес доставки</h3>
        <div class="additional-section__fields">

        <?php
    }

    public function close_additional_field_block()
    {
        ?>
        </div>
        </div>
        <?php
    }

    public function show_shipping_methods()
    {
        ?>
        <div class="shipping-methods-wrapper">
            <h4 class="inputs__title">Способ получения</h4>

            <?php wc_cart_totals_shipping_html(); ?>
        </div>
        <?php
    }

    public function change_cart_shipping_method_full_label($label, $method)
    {
        $price = $method->cost > 0 ? '(+' . $method->cost . ' руб.)' : '(Бесплатно)';
        $label = '
<div class="method__content">
    <div class="method__text">
        <h5 class="method__name">' . $method->get_label() . '</h5>
    
    </div>
    
    <div class="method__price p3">' . $price . '</div>
</div>';

        return $label;
    }

    public function open_payment_methods_block()
    { ?>
        <div class="payment-methods-wrapper">
        <h4 class="inputs__title">Способы оплаты</h4>
    <?php }

    public function close_payment_methods_block()
    { ?>
        </div>
        <?php
    }

    public function second_place_order_button()
    {
        $order_button_text = apply_filters('woocommerce_order_button_text', __("Place order", "woocommerce"));
        echo '<button type="submit" class="button btn alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>';

        wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce');
    }

    /*
     * PAGE-FAVORITES
     * */

    public function updateFavorites()
    {
        if (WCFAVORITES()->count_items() > 99) {
            echo '99+';
        } else {
            echo WCFAVORITES()->count_items();
        }
        wp_die();
    }

    public function wc_clear_favorite_url()
    {
        if (isset($_REQUEST['clear-fav'])) {
            unset($_COOKIE['WC_FAVORITES']);
        }
    }
}