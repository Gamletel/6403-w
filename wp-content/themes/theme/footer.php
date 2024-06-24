<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Company
 */

$logo = theme('logo_text');
$phones = @settings('phones');
$emails = @settings('emails');
$socials = @settings('socials');
//$addresses = @settings('addresses');

?>

<footer id="footer" class="site-footer">
    <div class="notice"></div>

    <div class="footer__top">
        <div class="container">
            <div class="footer__top-wrapper">
                <?php if ($logo) { ?>
                    <a href="/" class="logo">
                        <h4><?= $logo; ?></h4>
                    </a>
                <?php } ?>

                <div class="menus">
                    <?php if (is_nav_menu('Главное-футер')) { ?>
                        <div class="menu">
                            <h6 class="menu__title">Меню</h6>

                            <?php wp_nav_menu([
                                'theme_location' => 'mobileMenu',
                                'container' => false,
                                'menu' => 'Главное-футер',
                                'menu_class' => 'menuFooter',
                                'echo' => true,
                                'fallback_cb' => 'wp_page_menu',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth' => 2,
                            ]); ?>
                        </div>
                    <?php } ?>

                    <?php if (is_nav_menu('Каталог-футер')) { ?>
                        <div class="menu catalog">
                            <h6 class="menu__title">Каталог</h6>

                            <?php wp_nav_menu([
                                'theme_location' => 'mobileMenu',
                                'container' => false,
                                'menu' => 'Каталог-футер',
                                'menu_class' => 'menuFooter',
                                'echo' => true,
                                'fallback_cb' => 'wp_page_menu',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth' => 2,
                            ]); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="footer__contacts">
                    <div class="btn" data-modal="callback">Заказать звонок</div>

                    <?php if ($phones) { ?>
                        <div class="contacts">
                            <div class="contacts__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                                     fill="none">
                                    <g clip-path="url(#clip0_577_1110)">
                                        <path d="M4.75147 2.12861C4.59961 1.74895 4.2319 1.5 3.823 1.5H2.44737C1.92415 1.5 1.5 1.92417 1.5 2.44739C1.5 6.89473 5.10539 10.5 9.55273 10.5C10.076 10.5 10.5 10.0759 10.5 9.55266L10.4999 8.17701C10.4999 7.76811 10.251 7.40043 9.8713 7.24857L8.55357 6.72144C8.21253 6.58503 7.82427 6.64651 7.54209 6.88165L7.20154 7.16536C6.80421 7.49647 6.21999 7.46999 5.85427 7.10427L4.89568 6.14575C4.52996 5.78004 4.50361 5.19577 4.83472 4.79844L5.11841 4.45799C5.35355 4.17581 5.41501 3.78747 5.2786 3.44643L4.75147 2.12861Z"
                                              stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_577_1110">
                                            <rect width="12" height="12" fill="var(--card)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>

                            <div class="contacts__wrapper">
                                <div class="contacts__title p3">Номер телефона</div>

                                <a href="tel:<?= $phones[0]['value']; ?>" class="contact p2">
                                    <?= $phones[0]['name']; ?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($emails) { ?>
                        <div class="contacts">
                            <div class="contacts__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                                     fill="none">
                                    <path d="M2 3L6.11429 6L9.99997 3M10.5 4.09998V7.89998C10.5 8.46003 10.5001 8.7401 10.3911 8.95401C10.2952 9.14218 10.1421 9.29512 9.95389 9.39099C9.73998 9.49998 9.46015 9.5 8.9001 9.5H3.1001C2.54005 9.5 2.25981 9.49998 2.0459 9.39099C1.85774 9.29512 1.70487 9.14218 1.60899 8.95401C1.5 8.7401 1.5 8.46003 1.5 7.89998V4.09998C1.5 3.53992 1.5 3.25993 1.60899 3.04602C1.70487 2.85786 1.85774 2.70487 2.0459 2.60899C2.25981 2.5 2.54005 2.5 3.1001 2.5H8.9001C9.46015 2.5 9.73998 2.5 9.95389 2.60899C10.1421 2.70487 10.2952 2.85786 10.3911 3.04602C10.5001 3.25993 10.5 3.53992 10.5 4.09998Z"
                                          stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <div class="contacts__wrapper">
                                <div class="contacts__title p3">Электронная почта</div>

                                <a href="tel:<?= $emails[0]['value']; ?>" class="contact p2">
                                    <?= $emails[0]['name']; ?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($socials) { ?>
                        <div class="socials">
                            <?php foreach ($socials as $social) {
                                $value = $social['value'];
                                $icon = get_image($social['icon'], 'full');
                                ?>
                                <a href="<?= $value; ?>" target="_blank" class="social">
                                    <?= $icon; ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="container">
            <div class="footer__bottom-wrapper">
                <a href="/privacy-policy" target="_blank" class="policy p3">
                    Политика конфиденциальности
                </a>

                <a href="https://grampus-studio.ru/?utm_source=client&utm_keyword=<?= get_site_url(); ?>;"
                   target="_blank" class="grampus p3">
                    Сайт разработан

                    <?= inline('assets/images/GRAMPUS.svg'); ?>
                </a>
            </div>
        </div>
    </div>
</footer>

<div id="modal-callback" class="theme-modal">
    <div class="close-modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M9.47297 0L6 3.47295L2.52705 0L0 2.52705L3.47297 6L0 9.47295L2.52703 12L6 8.52703L9.47297 12L12 9.47295L8.52703 5.99998L12 2.52703L9.47297 0Z"
                  fill="#424242"/>
        </svg>
    </div>
    <div class="form__holder">
        <?php get_form('callback-modal') ?>
    </div>
</div>

<div id="modal-success" class="theme-modal">
    <div class="close-modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M9.47297 0L6 3.47295L2.52705 0L0 2.52705L3.47297 6L0 9.47295L2.52703 12L6 8.52703L9.47297 12L12 9.47295L8.52703 5.99998L12 2.52703L9.47297 0Z"
                  fill="#424242"/>
        </svg>
    </div>

    <h2 class="block-title">
        Спасибо!
    </h2>

    <h3>
        Ваша заявка отправлена
    </h3>
</div>

<div id="modal-error" class="theme-modal">
    <div class="close-modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M9.47297 0L6 3.47295L2.52705 0L0 2.52705L3.47297 6L0 9.47295L2.52703 12L6 8.52703L9.47297 12L12 9.47295L8.52703 5.99998L12 2.52703L9.47297 0Z"
                  fill="#424242"/>
        </svg>
    </div>

    <h2 class="block-title">
        Ошибка!
    </h2>

    <h3>
        Во время отправки произошла ошибка, пожалуйста, попробуйте позже!
    </h3>
</div>

<?php wp_footer(); ?>

</body>
</html>