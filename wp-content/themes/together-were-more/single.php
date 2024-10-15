<?php
/**
 * The template for displaying all Profile Posts
 *
 * @package ChoctawNation
 */

use ChoctawNation\Asset_Loader;
use ChoctawNation\Enqueue_Type;

new Asset_Loader( 'single', Enqueue_Type::both, 'pages' );
get_header();
?>

<article <?php post_class(); ?>>

	<?php
	get_template_part( 'template-parts/profile/section', 'hero' );
	get_template_part( 'template-parts/nav', 'breadcrumbs' );
	$sections = get_field( 'article' );
	if ( $sections ) {
		foreach ( $sections as $section ) {
			$template     = str_replace( '_', '-', $section['acf_fc_layout'] );
			$section_type = $section['acf_fc_layout'];
			get_template_part( 'template-parts/profile/content', $template, $section );
		}
	}
	?>
</article>

<?php
get_footer();
