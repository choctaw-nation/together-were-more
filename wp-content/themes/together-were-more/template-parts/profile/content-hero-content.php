<?php
/**
 * The Profile Hero Content
 *
 * @package ChoctawNation
 */

$color = isset( $args['color'] ) ? $args['color'] : 'white';
?>
<span class="h4 ls-3 text-uppercase mb-0">Our stories make us more</span>
<?php
get_template_part(
	'template-parts/ui/hr',
	'diamonds',
	array(
		'class' => 'my-1',
		'color' => $color,
	)
);
?>
<h2 class="display-1 text-uppercase mb-0 text-center"><?php the_title(); ?></h2>
<p class="text-center fw-light display-5 text-uppercase mb-3">
	<?php the_field( 'meta_title' ); ?>
</p>
<?php
get_template_part(
	'template-parts/ui/button',
	'video-modal-trigger',
	array(
		'no_modal'            => true,
		'featured_profile_id' => get_the_ID(),
		'class'               => 'fs-6' . ( 'white' === $color ? ' btn-outline-light' : " btn-outline-{$color}" ),
	)
);
