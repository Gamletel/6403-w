<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theme
 */

$post_type_obj = get_post_type_object($post_type);

$title = apply_filters('post_type_archive_title', $post_type_obj->labels->name, $post_type);

get_header();
?>

	<main id="primary" class="archive archive-stocks block-margin">
		<div class="container">
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}?>
			</div>

			<h1 class="page-title">
				<?= $title; ?>
			</h1>

            <?php if ( have_posts() ) { ?>

				<div class="archive__holder">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						?>

                        <?php get_template_part('stock-card') ?>

					<?php endwhile; ?>
				</div>
    
			<?php
				
				pagination();
	
            }else {
	
	            get_template_part('template-parts/content', 'none');
	
            }
			?>
		</div>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
