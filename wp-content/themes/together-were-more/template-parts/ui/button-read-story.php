<?php
/**
 * Read Story Button
 * Links to the single post page
 *
 * @package ChoctawNation
 */

$classes    = isset( $args['class'] ) ? $args['class'] : '';
$profile_id = isset( $args['profile_id'] ) ? $args['profile_id'] : get_the_ID();

$post_status         = get_post_status( $profile_id );
$default_button_text = 'Read Story';
if ( 'future' === $post_status ) {
	$month               = get_the_date( 'M', $profile_id );
	$default_button_text = "Read Story in {$month}";
	$button_element      = 'button';
}
$button_text = isset( $args['button_text'] ) ? $args['button_text'] : $default_button_text;
if ( ! empty( $classes ) ) {
	$classes = is_array( $classes ) ? $classes : array( $classes );
}

$default_classes = array(
	'btn',
	'text-uppercase',
	'mt-auto',
	'pt-2',
	'align-self-start',
);
$button_classes  = array_merge( $default_classes, $classes );

if ( get_post_status() === 'future' ) {
	$button_text = "<i class='fa-light fa-book'></i> Read Story in " . get_the_date( 'M' );
	echo "<button class='btn {$button_classes} text-uppercase' disabled>{$button_text}</button>";
} else {
	echo '<a href="' . get_the_permalink( $profile_id ) . '" class="' . join( ' ', $button_classes ) . '">'
	. $button_text . '</a>';
}
