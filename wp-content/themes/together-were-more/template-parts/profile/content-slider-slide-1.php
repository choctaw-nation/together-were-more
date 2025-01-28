<?php
/**
 * Profile Slider Slide 1
 *
 * @package ChoctawNation
 */

$slide_1 = $args['slide_1'];
?>

<div class="slide-container h-100 position-relative">
	<?php
	echo wp_get_attachment_image(
		$slide_1['primary_image'],
		'full',
		false,
		array(
			'class'   => 'object-fit-container w-100 h-100',
			'loading' => 'lazy',
		)
	);
	?>
	<span class="font-script position-absolute fs-3 z-3 text-dark" id="swipe-text" data-aos="fade-in" data-aos-offset="200">Swipe &rightarrow;</span>
</div>
