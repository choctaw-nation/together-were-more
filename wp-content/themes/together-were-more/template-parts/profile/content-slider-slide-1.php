<?php
/**
 * Profile Slider Slide 1
 *
 * @package ChoctawNation
 */

$slide_1 = $args['slide_1'];

?>

<div class="slide-container h-auto">
	<div class="d-grid h-100 overflow-hidden">
		<div class="cell cell--1">
			<?php
			echo wp_get_attachment_image(
				$slide_1['primary_image'],
				'full',
				false,
				array(
					'class'   => 'w-100 h-100 object-fit-scale',
					'loading' => 'lazy',
				)
			);
			?>
		</div>
		<div class="cell cell--2 mh-100 d-flex z-2">
			<?php
			echo wp_get_attachment_image(
				$slide_1['transparent_image'],
				'large',
				false,
				array(
					'class'   => 'w-75 h-75 object-fit-scale',
					'loading' => 'lazy',
				)
			);
			?>
		</div>
	</div>
	<span class="font-script position-absolute display-3 text-dark" id="swipe-text" data-aos="fade-in" data-aos-offset="200">Swipe -></span>
</div>
