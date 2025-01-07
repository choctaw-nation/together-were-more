<?php
/**
 * Profile Slider Slide 5
 *
 * @package ChoctawNation
 */

$slide_5 = $args['slide_5'];
echo "<div class='image-container p-4 p-md-5'>";
echo wp_get_attachment_image(
	$slide_5['image'],
	'full',
	false,
	array(
		'class'   => 'w-100 h-100 object-fit-cover',
		'loading' => 'lazy',
	)
);
echo '</div>';
