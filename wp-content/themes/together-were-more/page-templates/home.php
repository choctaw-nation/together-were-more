<?php
/**
 * Template Name: Home Page Template
 * The default page template
 *
 * @package ChoctawNation
 */

get_header();
?>
<main <?php post_class(); ?>>
	<?php
	$sections = array(
		'hero'       => 'section',
		'who-we-are' => 'home/section',
	);
	foreach ( $sections as $part => $prefix ) {
		get_template_part( "template-parts/{$prefix}", $part );
	}
	?>
</main>
<?php
get_footer();
