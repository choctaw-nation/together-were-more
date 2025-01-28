<?php
/**
 * Profile Slider Slide 5
 *
 * @package ChoctawNation
 */

$slide_5 = $args['slide_5'];
?>
<div class="ratio ratio-1x1">
<?php
echo wp_get_attachment_image(
	$slide_5['image'],
	'full',
	false,
	array(
		'class'   => 'w-100 h-100 object-fit-cover',
		'loading' => 'lazy',
	)
);
?>
</div>
