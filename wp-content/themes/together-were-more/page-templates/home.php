<?php
/**
 * Template Name: Home Page Template
 * The default page template
 *
 * @package ChoctawNation
 */

use ChoctawNation\Asset_Loader;
use ChoctawNation\Enqueue_Type;

new Asset_Loader( 'home', Enqueue_Type::both, 'pages' );
get_header();
?>
<main <?php post_class(); ?>>
	<?php
	$sections = array(
		'hero'               => 'home/section',
		'who-we-are'         => 'home/section',
		'current-feature'    => 'home/section',
		'category-swiper'    => 'home/section',
		'category-spotlight' => 'home/section',
	);
	foreach ( $sections as $part => $prefix ) {
		get_template_part( "template-parts/{$prefix}", $part );
	}
	?>
</main>
<?php
get_footer();
