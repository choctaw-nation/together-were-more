<?php
/**
 * Template Name: Blank Page Template
 * A blank page template.
 *
 * @package ChoctawNation
 */

get_header();
?>
<main <?php post_class( 'container my-5' ); ?>>
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<?php
			the_title( '<h1>', '</h1>' );
			the_field( 'page_content' );
			?>
		</div>
	</div>
</main>
<?php
get_footer();