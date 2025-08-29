<?php
/**
 * The Profile Hero Content
 *
 * @package ChoctawNation
 */

$color = isset( $args['color'] ) ? $args['color'] : 'white';
?>
<span class="h5 ls-3 text-uppercase mb-0 fw-normal">Our stories make us more</span>
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
<h2 class="display-2 text-uppercase mb-0 text-center"><?php the_title(); ?></h2>
<p class="text-center fw-light display-6 text-uppercase mb-3">
	<?php
	$mp_title = mp_get_field( 'meta_profile_title' );
	if ( $mp_title ) {
		echo esc_html( $mp_title );
	} else {
		the_field( 'meta_title' );
	}
	?>
</p>
<?php
get_template_part(
	'template-parts/ui/button',
	'video-modal-trigger',
	array(
		'no_modal'            => true,
		'featured_profile_id' => get_the_ID(),
		'class'               => 'white' === $color ? ' btn-outline-light' : " btn-outline-{$color}",
	)
);
