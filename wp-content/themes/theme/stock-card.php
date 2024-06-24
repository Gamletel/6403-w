<?php
$terms = wp_get_post_terms($post->ID, 'stocks_categories');
$title = get_the_title($post);
$short_description = get_field('short_description', $post);
$link = get_permalink($post);
$thumbnail = get_the_post_thumbnail_url($post, 'full');
?>
<div class="stock-card">
    <div class="stock__content">
        <?php if (!empty($terms)) {?>
            <div class="stock__terms">
                <?php foreach ($terms as $term) {
                    $name = $term->name;
                    ?>
                    <div class="term p2">
                        <?= $name; ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <h4 class="stock__title"><?= $title; ?></h4>

        <?php if ($short_description) {?>
            <div class="stock__short-description p2">
                <?= $short_description; ?>
            </div>
        <?php } ?>

        <a href="<?= $link; ?>" class="stock__link link">
            <?= inline('assets/images/link.svg'); ?>

            Участвовать в акции
        </a>
    </div>

    <?php if ($thumbnail) {?>
        <img src="<?= $thumbnail; ?>" alt="" class="stock__thumbnail">
    <?php } ?>
</div>
