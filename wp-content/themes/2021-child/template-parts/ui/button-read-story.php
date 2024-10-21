<?php
/**
 * Read Story Button
 * Links to the single post page
 *
 * @package ChoctawNation
 */

$classes    = isset( $args['class'] ) ? $args['class'] : '';
$profile_id = isset( $args['profile_id'] ) ? $args['profile_id'] : get_the_ID();

$pronouns            = get_field( 'meta_pronouns', $profile_id );
$default_button_text = "<i class='fa-light fa-book'></i> Read {$pronouns} Story";
$button_text         = isset( $args['button_text'] ) ? $args['button_text'] : $default_button_text;
if ( ! empty( $classes ) ) {
	$classes = is_array( $classes ) ? $classes : array( $classes );
}

$default_classes = array(
	'btn',
	'text-uppercase',
);
$button_classes  = array_merge( $default_classes, $classes );
?>
<a href="<?php the_permalink( $profile_id ); ?>" class="<?php echo join( ' ', $button_classes ); ?>">
	<?php echo $button_text; ?>
</a>
