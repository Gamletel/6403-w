<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme
 */

$logo = theme('logo_text');
$phones = @settings('phones');
$emails = @settings('emails');
$socials = @settings('socials');
$header_additional_text = theme('header_additional_text');
$header_file_btn = theme('header_file_btn');
global $WoocommerceCompare;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="site-header">
    <div class="header">
        <div class="header__top">
            <div class="container">
                <div class="header__top-wrapper">
                    <div class="contacts">
                        <?php if (!empty($phones)) {
                            $name = $phones[0]['name'];
                            $value = $phones[0]['value'];
                            ?>
                            <a href="tel:<?= $value; ?>" class="phone">
                                <div class="phone__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                                         fill="none">
                                        <g clip-path="url(#clip0_501_158)">
                                            <path d="M4.75147 2.12861C4.59961 1.74895 4.2319 1.5 3.823 1.5H2.44737C1.92415 1.5 1.5 1.92417 1.5 2.44739C1.5 6.89473 5.10539 10.5 9.55273 10.5C10.076 10.5 10.5 10.0759 10.5 9.55266L10.4999 8.17701C10.4999 7.76811 10.251 7.40043 9.8713 7.24857L8.55357 6.72144C8.21253 6.58503 7.82427 6.64651 7.54209 6.88165L7.20154 7.16536C6.80421 7.49647 6.21999 7.46999 5.85427 7.10427L4.89568 6.14575C4.52996 5.78004 4.50361 5.19577 4.83472 4.79844L5.11841 4.45799C5.35355 4.17581 5.41501 3.78747 5.2786 3.44643L4.75147 2.12861Z"
                                                  stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_501_158">
                                                <rect width="12" height="12" fill="var(--card)"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>

                                <h6>
                                    <?= $name; ?>
                                </h6>
                            </a>
                        <?php } ?>

                        <?php if ($socials) { ?>
                            <div class="socials">
                                <?php foreach ($socials as $social) {
                                    $value = $social['value'];
                                    $icon = wp_get_attachment_image_url($social['icon'], 'full');
                                    ?>
                                    <a href="<?= $value; ?>" class="social" target="_blank">
                                        <img src="<?= $icon; ?>" alt="" class="style-svg">
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="additionals">
                        <div class="btns">
                            <?php echo do_shortcode('[fibosearch]'); ?>

                            <a href="<?php echo $WoocommerceCompare->get_compare_page_url(); ?>"
                               class="compare-btn wc-btn">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21"
                                     fill="none">
                                    <path d="M6 18.5L6 9.5" stroke="var(--card)" stroke-width="1.5"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6 5.5L6 2.5" stroke="var(--card)" stroke-width="1.5"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 11.5L14 2.5" stroke="var(--card)" stroke-width="1.5"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 18.5V15.5" stroke="var(--card)" stroke-width="1.5"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="14" cy="13.5" r="2" transform="rotate(-90 14 13.5)" stroke="var(--card)"
                                            stroke-width="1.5"/>
                                    <circle cx="6" cy="7.5" r="2" transform="rotate(-90 6 7.5)" stroke="var(--card)"
                                            stroke-width="1.5"/>
                                </svg>

                                <?php echo do_shortcode('[compare-counter-html]'); ?>
                            </a>

                            <a href="<?= wc_get_cart_url(); ?>" class="cart-btn wc-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                     fill="none">
                                    <path d="M2.5 2.5H2.72362C3.11844 2.5 3.31602 2.5 3.47705 2.57123C3.61903 2.63403 3.74059 2.73525 3.82813 2.86346C3.92741 3.00889 3.96315 3.20305 4.03483 3.59131L5.83337 13.3334L14.5162 13.3333C14.895 13.3333 15.0847 13.3333 15.2413 13.2665C15.3795 13.2076 15.4991 13.1123 15.5876 12.9909C15.6879 12.8533 15.7303 12.6688 15.8154 12.2998L17.1231 6.6331C17.2519 6.0752 17.3163 5.79634 17.2455 5.57719C17.1835 5.38505 17.0533 5.22195 16.88 5.11827C16.6824 5 16.3965 5 15.8239 5H4.58333M15 17.5C14.5398 17.5 14.1667 17.1269 14.1667 16.6667C14.1667 16.2064 14.5398 15.8333 15 15.8333C15.4602 15.8333 15.8333 16.2064 15.8333 16.6667C15.8333 17.1269 15.4602 17.5 15 17.5ZM6.66667 17.5C6.20643 17.5 5.83333 17.1269 5.83333 16.6667C5.83333 16.2064 6.20643 15.8333 6.66667 15.8333C7.1269 15.8333 7.5 16.2064 7.5 16.6667C7.5 17.1269 7.1269 17.5 6.66667 17.5Z"
                                          stroke="var(--card)" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>

                                <div id="cart-count" class="number count">
                                    <?= WC()->cart->get_cart_contents_count(); ?>
                                </div>
                            </a>
                        </div>

                        <?php if ($header_additional_text) { ?>
                            <h6 class="header__additional-text" data-modal="callback">
                                <?= $header_additional_text; ?>
                            </h6>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="header__bottom">
            <div class="container">
                <div class="header__bottom-wrapper">
                    <?php if ($logo) { ?>
                        <a href="/" class="logo">
                            <h4><?= $logo; ?></h4>
                        </a>
                    <?php } ?>

                    <?php if (is_nav_menu('Главное')) {
                        wp_nav_menu([
                            'theme_location' => 'mobileMenu',
                            'container' => false,
                            'menu' => 'Главное',
                            'menu_class' => 'menuTop',
                            'echo' => true,
                            'fallback_cb' => 'wp_page_menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth' => 2,
                        ]);
                    } ?>

                    <?php if ($header_file_btn) {
                        $file = $header_file_btn['file'];
                        $text = $header_file_btn['text'];
                        ?>
                        <a href="<?= $file; ?>" class="btn" download>
                            <?= $text; ?>
                        </a>
                    <?php } ?>

                    <div class="burger open_menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="mobile-mnu">
        <div id="close-mnu">×</div>

        <a href="/" class="logo__holder">
            <h4 class="logo">
                <?= $logo; ?>
            </h4>
        </a>

        <?php
        wp_nav_menu([
            'theme_location' => 'mobileMenu',
            'container' => false,
            'menu' => 'Главное',
            'menu_class' => 'menuTop',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 2,
        ]);
        ?>

        <?php if (!empty($phones)) { ?>
            <div class="phones__holder">
                <?php foreach ($phones as $item) { ?>
                    <a href="tel:<?= $item['value']; ?>" class="phone__item">
                        <?= file_get_contents(TEMPLATEPATH . '/assets/images/phone.svg'); ?>
                        <?= $item['name']; ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if (!empty($emails)): ?>
            <div class="email__holder">
                <?php foreach ($emails as $item) { ?>
                    <a href="mailto:<?= $item['value']; ?>" class="email__item">
                        <?= file_get_contents(TEMPLATEPATH . '/assets/images/mail.svg'); ?>
                        <?php echo $item['name']; ?>
                    </a>
                <?php } ?>
            </div>
        <?php endif ?>
        <?php if (!empty($adresses)): ?>
            <div class="adresses__holder">
                <?php foreach ($adresses as $adress) { ?>
                    <?= $adress['value']; ?>
                <?php } ?>
            </div>
        <?php endif ?>
        <?php if (!empty($socials)): ?>
            <div class="soc__holder">
                <?php foreach ($socials as $item) { ?>
                    <a href="<?= $item['value']; ?>" class="soc__item" target="_blank">
                        <?= get_image($item['icon'], [24, 24]); ?>
                    </a>
                <?php } ?>
            </div>
        <?php endif ?>

        <?php if ($header_file_btn) {
            $file = $header_file_btn['file'];
            $text = $header_file_btn['text'];
            ?>
            <a href="<?= $file; ?>" class="btn" download>
                <?= $text; ?>
            </a>
        <?php } ?>

        <?php if ($header_additional_text) { ?>
            <div class="btn" data-modal="callback"><?= $header_additional_text; ?></div>
        <?php } ?>
    </div>
</header><!-- #masthead -->
