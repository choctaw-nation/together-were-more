<?php
/**
 * Category Swiper Section
 *
 * @package ChoctawNation
 */

$acf_fields = get_field( 'category_slider' );
wp_enqueue_style( 'category-swiper' );
wp_enqueue_script( 'category-swiper' );
?>
<section id="category-preview" class="position-relative overflow-hidden">
	<?php
	echo wp_get_attachment_image(
		$acf_fields['background_image'],
		'full',
		false,
		array(
			'class'   => 'position-absolute top-0 start-0 w-100 h-100 bg-image z-n1',
			'loading' => 'lazy',
		)
	);
	?>
	<div class="container position-relative d-flex flex-column justify-content-center h-100">
		<div class="row justify-content-center my-5 align-items-center position-relative">
			<div class="col-lg-6">
				<p class="display-1 text-white fw-normal text-center mb-0">
					<?php echo esc_textarea( $acf_fields['subheadline'] ); ?>
				</p>
				<p class="font-script text-white text-center fs-3 mb-0" data-aos="fade-in" data-aos-delay="300">Swipe &rightarrow;</p>
			</div>
			<div class="offset-lg-5 col-lg-5 position-absolute z-2">
				<div class="swiper overflow-visible">
					<div class="swiper-wrapper align-items-stretch">
						<div class="swiper-slide h-auto" aria-label="This slide is intentionally left blank"></div>
						<?php
						$categories = cno_get_categories_array();
						foreach ( $categories as $category ) {
							echo "<div class='swiper-slide shadow h-auto'>";
							get_template_part( 'template-parts/card', 'category-preview', array( 'category' => $category ) );
							echo '</div>';
						}
						?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</div>
	</div>
</section>
