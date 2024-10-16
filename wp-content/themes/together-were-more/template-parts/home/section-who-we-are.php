<?php
/**
 * Who We Are
 * Section with animated text
 *
 * @package ChoctawNation
 */

$section = get_field( 'who_we_are' );
$img_id  = $section['background_image']['id'];
wp_enqueue_style( 'who-we-are' );
wp_enqueue_script( 'who-we-are' );
?>
<section class='position-relative py-5 overflow-hidden' id='who-we-are'>
	<?php
	echo wp_get_attachment_image(
		$img_id,
		'full',
		false,
		array(
			'class'       => 'position-absolute top-0 start-0 w-100 h-100 z-n1 object-fit-cover',
			'aria-hidden' => 'true',
		)
	);
	?>
	<div class='container position-relative z-1'>
		<div class='row row-cols-1 justify-content-center'>
			<div class='col-xl-6 text-center statements'>
				<div class='statement text-white text-uppercase fw-bold'>
					We are<br />
					<p class='display-2 text-white text-uppercase lh-sm' id='statement-word' data-statements="artists,culture,inspiring,competitors,Choctaw Proud">
						Choctaw Proud.
					</p>
				</div>
			</div>
		</div>
		<div class='row justify-content-center'>
			<div class='col-lg-8 text-center'>
				<p class='font-pill-gothic fw-lighter text-white'>
					Anyone can be Choctaw Proud. The Choctaw Proud are humble,
					appreciative people who value faith, family and culture. We
					honor the past, live in the present and look to the future.
					We are resilient people, overcoming adversity with grace and
					dignity. Those who are Choctaw Proud work hard to be
					successful and give back to their communities.
				</p>
			</div>
		</div>
	</div>
</section>
