<?php
/**
 * The Hero Section
 *
 * @package ChoctawNation
 */

?>

<section class="front-page-hero hero position-relative overflow-hidden py-5 d-flex flex-column align-items-stretch justify-content-center">
	<?php the_post_thumbnail( 'hero', array( 'class' => 'object-fit-cover position-absolute top-0 start-0 w-100 h-100 z-n1' ) ); ?>
	<div class="image-overlay bg-black bg-opacity-50 position-absolute top-0 z-1 w-100 h-100"></div>
	<div class="container position-relative z-2 py-5 text-center">
		<div class="row justify-content-center">
			<div class="col-10 col-lg-8">
				<span class="h1 text-uppercase text-white mb-0 fw-normal">Our stories make us more</span>
				<?php
				get_template_part(
					'template-parts/ui/hr',
					'diamonds',
					array(
						'class' => 'my-2',
						'color' => 'white',
					)
				);
				?>
			</div>
		</div>
		<div class="row row-cols-1">
			<div class="col">
				<h1 class="text-white fw-bolder display-1 text-uppercase mb-0">
					Together We're More
				</h1>
			</div>
		</div>
	</div>
	<figure class="mb-0 ratio ratio-1x1 text-white border border-light border-2 rounded-circle position-absolute bottom-0 start-50 translate-middle z-2 p-4 overflow-hidden"
			id="scroll-down-icon">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="text-white d-block" style="fill:currentColor">
			<path style="fill:currentColor;stroke:currentColor"
					d="M267.3 395.3c-6.2 6.2-16.4 6.2-22.6 0l-192-192c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L256 361.4 436.7 180.7c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6l-192 192z" />
		</svg>
	</figure>
</section>
