<?php
/**
 * Template Name: Default Page Template
 * The default page template
 *
 * @package ChoctawNation
 */

get_header();
?>
<main <?php post_class( array( 'd-flex', 'flex-column', 'align-items-stretch', 'row-gap-5', 'mb-5 ' ) ); ?>>
	<?php get_template_part( 'template-parts/section', 'hero' ); ?>
</main>
<?php
get_footer();