<?php
/**
 * Diamonds with HRs
 *
 * @package ChoctawNation
 */

$class_list = isset( $args['class'] ) ? $args['class'] : '';
$color      = isset( $args['color'] ) ? $args['color'] : 'black';

$custom_classes  = $class_list && is_array( $class_list ) ? $class_list : array( $class_list );
$default_classes = array(
	'diamond-separator',
	'mb-0',
	'd-flex',
	'align-items-center',
	'justify-content-center',
	'position-relative',
	'column-gap-3',
);

$classes = array_merge( $default_classes, $custom_classes );

$hr_classes   = array( 'opacity-100 border-1 position-relative flex-shrink-1 flex-grow-1 my-0' );
$hr_classes[] = 'white' !== $color ? 'border-dark' : 'border-white';

?>

<figure class="<?php echo join( ' ', $classes ); ?>" aria-label="a stylized horizontal splitter with diamonds in the center">
	<hr class="<?php echo join( ' ', $hr_classes ); ?>" aria-hidden="true" />
	<div class="diamonds" style="<?php echo "--color:var(--bs-{$color});"; ?>" aria-hidden="true">
		<?php get_template_part( 'template-parts/ui/content', 'diamonds' ); ?>
	</div>
	<hr class="<?php echo join( ' ', $hr_classes ); ?>" aria-hidden="true" />
</figure>
