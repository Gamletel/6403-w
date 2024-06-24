<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$show_all = get_field('show_all');
if ($show_all) {
    $stocks = get_posts(array(
        'post_type' => 'stocks',
        'numberposts' => -1,
    ));
} else {
    $stocks = get_field('stocks');
}
?>
<?php if ($stocks) { ?>
    <div id="stocks-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($stocks as $stock) {
                    setup_postdata( $GLOBALS['post'] = $stock );
                    ?>
                    <div class="swiper-slide" data-id="<?= $post->ID; ?>">
                        <?php get_template_part('stock-card') ?>
                    </div>
                <?php }
                wp_reset_postdata();
                ?>
            </div>
        </div>

        <div class="swiper-additionals">
            <div class="swiper-pagination"></div>

            <div class="swiper-btns">
                <div class="swiper-btn-prev"><?= inline('assets/images/swiper-btn.svg'); ?></div>

                <div class="swiper-btn-next"><?= inline('assets/images/swiper-btn.svg'); ?></div>
            </div>
        </div>
    </div>
<?php } ?>
