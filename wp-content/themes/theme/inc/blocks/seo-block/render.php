<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$text = get_field('text');
$image = wp_get_attachment_image_url(get_field('image'), 'full');
?>
<div id="seo-block" class="<?= $classes; ?> <?= $align; ?> block-margin">
    <?php if ($image) { ?>
        <img src="<?= $image; ?>" alt="" class="block__image">
    <?php } ?>

    <?php if ($text || $block_title) { ?>
        <div class="block__text">
            <?php if ($block_title) { ?>
                <h3 class="block__title"><?= $block_title; ?></h3>
            <?php } ?>

            <?php if ($text) { ?>
                <div class="text-block"><?= $text; ?></div>
            <?php } ?>
        </div>
    <?php } ?>
</div>