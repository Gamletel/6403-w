<?php
$link = get_permalink($post);
$thumbnail = get_the_post_thumbnail_url($post, 'full');
$short_description = get_field('short_description', $post);
$title = get_the_title($post);
$date = get_field('date', $post);
?>
<a href="<?= $link; ?>" class="blog-card">
    <?php if ($thumbnail) { ?>
        <div class="blog-card__thumbnail">
            <img src="<?= $thumbnail; ?>" alt="">
        </div>
    <?php } ?>

    <div class="blog-card__text">
        <?php if ($short_description) { ?>
            <div class="blog-card__short-description p3"><?= $short_description; ?></div>
        <?php } ?>

        <h6 class="blog-card__title"><?= $title; ?></h6>

        <?php if ($date) { ?>
            <div class="blog-card__date p3"><?= $date; ?></div>
        <?php } ?>
    </div>
</a>