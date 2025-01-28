<?php
/**
 * Profile Slider Slide 4
 *
 * @package ChoctawNation
 */

$slide_4 = $args['slide_4'];
?>
<div class="slide-container h-100 position-relative">
	<?php
	echo wp_get_attachment_image(
		$slide_4['image'],
		'full',
		false,
		array(
			'class'   => 'w-100 h-100 object-fit-cover',
			'loading' => 'lazy',
		)
	);
	?>
</div>
