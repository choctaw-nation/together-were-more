<?php
/**
 * Category Swiper Section
 *
 * @package ChoctawNation
 */

$acf = get_field( 'category_slider' );
wp_enqueue_style( 'category-swiper' );
wp_enqueue_script( 'category-swiper' );
?>
<section id="category-preview" class="py-5 position-relative overflow-hidden">
	<?php
	echo wp_get_attachment_image(
		$acf['background_image'],
		'full',
		false,
		array(
			'class'   => 'position-absolute top-0 start-0 w-100 h-100 bg-image',
			'loading' => 'lazy',
		)
	);
	?>
	<div class="container position-relative z-2">
		<div class="row">
			<div class="col-auto">
				<div id="header-container" class="border-1 border border-white position-relative p-4 mb-3">
					<h2 class="display-2 text-white text-uppercase mb-0">
						<?php echo esc_textarea( $acf['headline'] ); ?>
					</h2>
					<div class="diamonds position-absolute bottom-0" style="--color:white">
						<?php get_template_part( 'template-parts/ui/content', 'diamonds' ); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-between my-5 align-items-center position-relative">
			<div class="col-lg-6">
				<p class="display-1 text-white fw-normal">
					<?php echo esc_textarea( $acf['subheadline'] ); ?>
				</p>
			</div>
			<div class="col-lg-5">
				<div class="swiper overflow-visible">
					<div class="swiper-wrapper">
						<?php
						$categories = cno_get_categories_array();
						foreach ( $categories as $category ) {
							echo "<div class='swiper-slide shadow'>";
							get_template_part( 'template-parts/card', 'category-preview', array( 'category' => $category ) );
							echo '</div>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
