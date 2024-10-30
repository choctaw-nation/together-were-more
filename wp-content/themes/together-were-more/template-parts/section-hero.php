<?php
/**
 * The Hero Section
 *
 * @package ChoctawNation
 */

$has_overlay = isset( $args['has_overlay'] ) ? $args['has_overlay'] : false;
$the_overlay = $has_overlay && isset( $args['the_overlay'] ) ? $args['the_overlay'] : '<div class="image-overlay bg-black bg-opacity-25 position-absolute top-0 z-1 w-100 h-100"></div>';
?>

<section class="hero position-relative overflow-hidden py-5 d-flex flex-column align-items-stretch justify-content-center">
	<?php
	the_post_thumbnail( 'hero', array( 'class' => 'object-fit-cover position-absolute top-0 start-0 w-100 h-100 z-n1' ) );
	echo $the_overlay;
	?>
	<div class="container position-relative z-2 py-5 text-center">
		<div class="row justify-content-center">
			<div class="col-10 col-lg-8">
				<span class="h3 text-uppercase text-white mb-0 ls-3">Our stories make us more</span>
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
</section>
