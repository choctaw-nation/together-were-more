<?php
/**
 * Standard Page Output with default Hero section
 *
 * @package ChoctawNation
 */

get_header();
?>

<main <?php post_class( array( 'site-content', "page-{$post->post_name}" ) ); ?>>
	<?php get_template_part( 'template-parts/section', 'hero', array( 'id' => $post->ID ) ); ?>
	<article class="container">
		<?php the_content(); ?>
	</article>
</main>
<?php
get_footer();