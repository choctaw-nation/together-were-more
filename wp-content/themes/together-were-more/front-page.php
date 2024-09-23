<?php
/**
 * Homepage Template
 *
 * @package ChoctawNation
 */

use ChoctawNation\Asset_Loader;
use ChoctawNation\Enqueue_Type;

$loader = new Asset_Loader( 'frontPage', Enqueue_Type::both, 'pages' );

get_header(); ?>
<main <?php post_class( array( 'site-content', "page-{$post->post_name}" ) ); ?>>
	<?php get_template_part( 'template-parts/section', 'hero', array( 'id' => $post->ID ) ); ?>
	<section class="my-5 py-5">
		<div class="container">
			<div class="row row-cols-1 row-cols-lg-2 row-gap-3">
				<div class="col">Blank on purpose.</div>
				<div class="col text-bg-secondary py-5">
					<h2 class="text-white">A text element</h2>
					<p class="fs-6">A subheadline element that has a lot of text. Hopefully if I keep typing there will be enough characters to break onto a second line.</p>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();