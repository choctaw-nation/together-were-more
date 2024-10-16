<?php
/**
 * Diamond Separator
 *
 * @package ChoctawNation
 * @subpackage ACF
 */

$color_map  = array(
	'Artists'     => 'gold',
	'Culture'     => 'plum',
	'Inspire'     => 'violet',
	'Competitors' => 'garnet',
);
$color      = $color_map[ get_the_category()[0]->name ];
$location   = isset( $args['position'] ) ? $args['position'] : null;
$full_width = isset( $args['full_width'] ) ? $args['full_width'] : null;

if ( ! $color || ! $location || null === $full_width ) {
	return;
}

$alignment_map = array(
	'left'   => 'justify-content-start',
	'right'  => 'justify-content-end',
	'center' => 'justify-content-center',
);
$base_class    = 'diamond-separator ' . ( $full_width ? 'col-12' : 'col-7 col-lg-auto' );
?>
<div class='container'>
	<div class="<?php echo "row {$alignment_map[$location]} gx-0"; ?>">
		<div class="<?php echo $base_class; ?>">
			<?php
			get_template_part(
				'template-parts/ui/hr',
				'diamonds',
				array(
					'color' => $color,
					'class' => $full_width ? 'w-100' : '',
				)
			);
			?>
		</div>
	</div>
</div>
