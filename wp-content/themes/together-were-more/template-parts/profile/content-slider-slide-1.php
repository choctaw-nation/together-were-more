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
			'class'   => 'object-fit-scale position-absolute',
			'loading' => 'lazy',
		)
	);
	echo wp_get_attachment_image(
		$slide_1['transparent_image'],
		'large',
		false,
		array(
			'class'   => 'w-50 h-50 object-fit-scale z-2 position-absolute',
			'loading' => 'lazy',
		)
	);
	?>
	<span class="font-script position-absolute start-0 display-3 z-3 text-dark" id="swipe-text" data-aos="fade-in" data-aos-offset="200">Swipe -></span>
</div>
