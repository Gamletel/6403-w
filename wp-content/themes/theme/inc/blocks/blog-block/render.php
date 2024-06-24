<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$show_all = get_field('show_all');
if ($show_all) {
    $blog = get_posts(array(
        'numberposts' => -1,
        'post_type' => 'blog'
    ));
} else {
    $blog = get_field('blog');
}
$show_archive_link_btn = get_field('show_archive_link_btn');
?>
<?php if (!empty($blog)) { ?>
    <div id="blog-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($blog as $item) {
                    setup_postdata($GLOBALS['post'] = $item);
                    ?>
                    <div class="swiper-slide">
                        <?php get_template_part('blog-card') ?>
                    </div>
                <?php }
                wp_reset_postdata(); ?>
            </div>
        </div>

        <div class="swiper-additionals">
            <?php if (!$show_archive_link_btn) { ?>
                <div class="swiper-pagination"></div>
            <?php } ?>

            <div class="swiper-btns">
                <div class="swiper-btn-prev"><?= inline('assets/images/swiper-btn.svg'); ?></div>

                <div class="swiper-btn-next"><?= inline('assets/images/swiper-btn.svg'); ?></div>
            </div>

            <?php if ($show_archive_link_btn) {
                $archive_link = get_post_type_archive_link('blog');
                $archive_link_btn_text = get_field('archive_link_btn_text');
                ?>
                <a href="<?= $archive_link; ?>" class="btn card">
                    <?= $archive_link_btn_text; ?>
                </a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
