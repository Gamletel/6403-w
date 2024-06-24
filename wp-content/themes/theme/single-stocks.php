<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme
 */
$title = get_the_title();
$additional_text = get_field('additional_text');
$description = get_field('description');
$description_image = wp_get_attachment_image_url(get_field('description_image'), 'full');

get_header();
?>

    <main id="primary" class="site-main">
        <div class="container">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>

            <h1 class="page-title"><?= $title; ?></h1>

            <?php if ($description) { ?>
                <div class="single-stocks__description block-margin">
                    <div class="description__content">
                        <?php if ($additional_text) { ?>
                            <div class="additional-text"><?= $additional_text; ?></div>
                        <?php } ?>

                        <div class="description__text text-block">
                            <?= $description; ?>
                        </div>
                    </div>

                    <?php if ($description_image) { ?>
                        <div class="description__image">
                            <img src="<?= $description_image; ?>" alt="">
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="content">
                <?php the_content(); ?>
            </div>
        </div>
    </main><!-- #main -->

<?php
get_footer();
