<?php
/**
 * Template Name: TWM Classic
 * Template Post Type: post
 *
 * @package ChoctawNation
 */

use ChoctawNation\Asset_Loader;
use ChoctawNation\Enqueue_Type;

new Asset_Loader( 'single', Enqueue_Type::both, 'pages' );
get_header();
?>

<main <?php post_class(); ?>>
	<?php
	get_template_part( 'template-parts/profile/section', 'hero' );
	get_template_part( 'template-parts/nav', 'breadcrumbs' );
	$sections = get_field( 'article' );
	if ( $sections ) {
		echo '<article class="d-flex flex-column row-gap-5 align-items-stretch mb-5">';
		foreach ( $sections as $section ) {
			$template     = str_replace( '_', '-', $section['acf_fc_layout'] );
			$section_type = $section['acf_fc_layout'];
			get_template_part( 'template-parts/profile/content', $template, $section );
		}
		echo '</article>';
	}
	?>
</main>
<?php
get_template_part( 'template-parts/profile/aside', 'social-share' );
get_footer();