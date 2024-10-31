<?php
/**
 * Profile Slider Slide 2
 *
 * @package ChoctawNation
 */

$slide_2 = $args['slide_2'];

get_template_part(
	'template-parts/profile/content',
	'block-quote',
	array(
		'content' => $slide_2['quote'],
		'with_bg' => true,
		'class'   => 'display-5 text-center',
	)
);
