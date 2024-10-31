<?php
/**
 * Profile Slider Slide 4
 *
 * @package ChoctawNation
 */

$slide_4 = $args['slide_4'];
?>
<div class="slide-container h-auto position-relative">
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
	<div class="inner-frame border border-1 border-white position-absolute z-2">
	</div>
	<div class="inner-frame__diamonds position-absolute z-2">
		<?php get_template_part( 'template-parts/ui/content', 'diamonds' ); ?>
	</div>
</div>
