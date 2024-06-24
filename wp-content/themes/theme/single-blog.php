<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme
 */
$title = get_the_title();
$date = get_field('date');
$description = get_field('description');
$thumbnail = get_the_post_thumbnail_url($post, 'full');

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
                <div class="single-blog__description block-margin">
                    <div class="description__content">
                        <?php if ($date) { ?>
                            <div class="description__date p3"><?= $date; ?></div>
                        <?php } ?>

                        <div class="description__text text-block">
                            <?= $description; ?>
                        </div>
                    </div>

                    <?php if ($thumbnail) { ?>
                        <div class="description__image">
                            <img src="<?= $thumbnail; ?>" alt="">
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
