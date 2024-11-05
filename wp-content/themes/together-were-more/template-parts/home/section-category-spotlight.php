<?php
/**
 * Category Spotlight
 * Highlights the 3 most recent / upcoming stories from the selected category
 *
 * @package ChoctawNation
 */

$color_overlays = array(
	'Artists'     => 'gold',
	'Culture'     => 'violet',
	'Inspiring'   => 'plum',
	'Competitors' => 'garnet',
);

$bg_image  = get_template_directory_uri() . '/src/assets/black-bg-chevron-noise.png';
$spotlight = get_field( 'category_spotlight' )['category_to_spotlight'];
?>
<section id="category-spotlight" class="overflow-hidden">
	<div class="banner position-relative py-4">
		<img src="<?php echo $bg_image; ?>" class="position-absolute top-0 start-0 w-100 h-100 z-n1 object-fit-cover z-1" alt="" aria-hidden="true" loading="lazy" />
		<div class="<?php echo "overlay position-absolute top-0 w-100 h-100 z-2 bg-{$color_overlays[$spotlight->name]}"; ?>" style="mix-blend-mode: screen;">
		</div>
		<div class="container position-relative z-3">
			<div class="row">
				<div class="col-lg-4 text-center">
					<h2 class="text-white display-2 text-uppercase"><?php echo $spotlight->name; ?></h2>
					<?php get_template_part( 'template-parts/ui/hr', 'diamonds', array( 'color' => 'white' ) ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-dark row row-cols-1 row-cols-lg-3 gx-0 position-relative">
		<?php
		$posts_to_highlight =
		array(
			'posts_per_page' => 3,
			'post_status'    => array( 'publish', 'future' ),
			'cat'            => $spotlight->term_id,
			'order'          => 'DESC',
			'orderby'        => 'date',
		);
		$spotlights         = new WP_Query( $posts_to_highlight );

		if ( $spotlights->have_posts() ) {
			$spotlights->posts = array_reverse( $spotlights->posts );
			while ( $spotlights->have_posts() ) {
				$spotlights->the_post();
				echo "<div class='col'>";
				get_template_part( 'template-parts/card', 'post-preview', array( 'category' => $spotlight->name ) );
				echo '</div>';
			}
		}
		wp_reset_postdata();
		?>
	</div>
</section>
