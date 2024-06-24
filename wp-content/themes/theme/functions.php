<?php
require_once(__DIR__ . '/inc/woocommerce/hooks.php');

//=========== BASE CONFIG ============

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}


function theme_setup()
{

    load_theme_textdomain('theme', get_template_directory() . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('widgets');
    add_theme_support('widgets-block-editor');
    add_theme_support('woocommerce');

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

}

add_action('after_setup_theme', 'theme_setup');

add_action('pre_get_posts', 'product_per_page');

function product_per_page($product)
{
    if (!is_admin() && $product->is_main_query() && $product->is_post_type_archive('product')) {
        $product->set('posts_per_page', 12);
        $product->set('posts_per_archive_page', 12);
    }
}

add_action('pre_get_posts', 'stocks_per_page');

function stocks_per_page($stocks)
{
    if (!is_admin() && $stocks->is_main_query() && $stocks->is_post_type_archive('stocks')) {
        $stocks->set('posts_per_page', 8);
        $stocks->set('posts_per_archive_page', 8);
    }
}

add_action('pre_get_posts', 'blog_per_page');

function blog_per_page($blog)
{
    if (!is_admin() && $blog->is_main_query() && $blog->is_post_type_archive('blog')) {
        $blog->set('posts_per_page', 16);
        $blog->set('posts_per_archive_page', 16);
    }
}

/*
  PAGINATION
*/
function pagination()
{
    global $wp_query;

    $prev = __('<svg xmlns="http://www.w3.org/2000/svg" width="21" height="8" viewBox="0 0 21 8" fill="none">
  <path d="M20.3536 4.35355C20.5488 4.15829 20.5488 3.84171 20.3536 3.64645L17.1716 0.464466C16.9763 0.269204 16.6597 0.269204 16.4645 0.464466C16.2692 0.659728 16.2692 0.976311 16.4645 1.17157L19.2929 4L16.4645 6.82843C16.2692 7.02369 16.2692 7.34027 16.4645 7.53553C16.6597 7.7308 16.9763 7.7308 17.1716 7.53553L20.3536 4.35355ZM0 4.5H20V3.5H0V4.5Z" fill="white"/>
</svg>');
    $next = __('<svg xmlns="http://www.w3.org/2000/svg" width="21" height="8" viewBox="0 0 21 8" fill="none">
  <path d="M20.3536 4.35355C20.5488 4.15829 20.5488 3.84171 20.3536 3.64645L17.1716 0.464466C16.9763 0.269204 16.6597 0.269204 16.4645 0.464466C16.2692 0.659728 16.2692 0.976311 16.4645 1.17157L19.2929 4L16.4645 6.82843C16.2692 7.02369 16.2692 7.34027 16.4645 7.53553C16.6597 7.7308 16.9763 7.7308 17.1716 7.53553L20.3536 4.35355ZM0 4.5H20V3.5H0V4.5Z" fill="white"/>
</svg>');

    $args = array(
        'total' => $wp_query->max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'prev_text' => $prev,
        'next_text' => $next,
        'type' => 'array',
        'end_size' => 1,
        'mid_size' => 1,
    );

    $pag = paginate_links($args);

    if (isset($pag)) {
        if (get_query_var('paged') == 0) {
            array_unshift($pag, '<span class="prev page-numbers disabled">' . $prev . '</span>');
        }
        if ($wp_query->max_num_pages == get_query_var('paged')) {
            array_push($pag, '<span class="next page-numbers disabled">' . $next . '</span>');
        }
        $pag = preg_replace('~/page/1/?([\'"])~', '/"', $pag);

        echo '<div class="nav-links">' . implode("", $pag) . '</div>';
    }
}

function theme_scripts()
{

    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style('nouislider', get_template_directory_uri() . '/assets/css/nouislider.css');
    wp_enqueue_style('fonts', get_template_directory_uri() . '/assets/fonts/fonts.css');
    wp_enqueue_style('swiperCss', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css');
    wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/css/fancybox.min.css');

    wp_enqueue_script('swiperJs', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('swiperJsCustom', get_template_directory_uri() . '/assets/js/swiper.js', array('jquery', 'swiperJs'), _S_VERSION, true);
    wp_enqueue_script('fancyboxJs', get_template_directory_uri() . '/assets/js/fancybox.min.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('inputmask', get_template_directory_uri() . '/assets/js/inputmask.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('mobileMenu', get_template_directory_uri() . '/assets/js/modules/mobileMenu.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('themeModal', get_template_directory_uri() . '/assets/js/modules/themeModal.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'mobileMenu', 'themeModal', 'fancyboxJs', 'inputmask'), _S_VERSION, true);

}

add_action('wp_enqueue_scripts', 'theme_scripts');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


/*========= SUPPORT ES6 MODULES ===========*/
function scripts_as_es6_modules($tag, $handle, $src)
{

    if ('mobileMenu' === $handle || 'themeModal' === $handle || 'main' === $handle) {
        return str_replace('<script ', '<script type="module"', $tag);
    }

    return $tag;
}

// add_filter( 'script_loader_tag', 'scripts_as_es6_modules', 10, 3 );


/*========= ADD CANNONICAL LINKS ===========*/
add_filter('wpseo_canonical', 'return_canon');
function return_canon()
{
    if (is_paged()) {
        $canon_page = get_pagenum_link(1);
        return $canon_page;
    }
}


//============= THEME FUNCTIONS =============

require get_template_directory() . '/inc/template-functions.php';


/*=========== MENUS ==============*/

register_nav_menu('TopMenu', 'Верхнее меню');
register_nav_menu('footCat', 'Каталог подвал');
register_nav_menu('footMenu', 'Меню подвал');
register_nav_menu('mobileMenu', 'Мобильное меню');