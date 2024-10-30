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
				<span class="h1 text-uppercase text-white mb-0 fw-normal ls-3">Our stories make us more</span>
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
			id="scroll-down-icon" aria-label="scroll down">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16" aria-hidden="true">
			<path fill-rule="evenodd"
					d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z" />
		</svg>

	</figure>
</section>
