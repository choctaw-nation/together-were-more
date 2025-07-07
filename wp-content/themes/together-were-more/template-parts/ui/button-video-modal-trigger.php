<?php
/**
 * Video Modal Trigger Button
 *
 * @package ChoctawNation
 */

$featured_profile_id = isset( $args['featured_profile_id'] ) ? $args['featured_profile_id'] : false;
if ( false === $featured_profile_id ) {
	return;
}

if ( ! is_single() || ( is_single() && empty( get_the_content() ) ) ) {
	wp_enqueue_script( 'video-modal-trigger' );
} else {
	wp_enqueue_script( 'video-modal-trigger-no-lv' );
}
$button_text = isset( $args['button_text'] ) ? $args['button_text'] : '<i class="fa-light fa-play"></i>  Watch Video';
$classes     = isset( $args['class'] ) ? $args['class'] : '';
if ( $classes && is_array( $classes ) ) {
	$classes = implode( ' ', $classes );
}
$modal_title      = get_the_title( $featured_profile_id );
$video_id         = false;
$custom_thumbnail = false;
while ( have_rows( 'meta_video_details', $featured_profile_id ) ) {
	the_row();
	$video_url        = get_sub_field( 'video_url', false );
	$custom_thumbnail = get_sub_field( 'custom_thumbnail', false );
	$video_id         = cno_extract_vimeo_id( $video_url, );
}

$button_attributes = array(
	'type'             => 'button',
	'class'            => "text-uppercase modal-trigger pt-2 btn {$classes}",
	'data-video-id'    => $video_id,
	'data-modal-title' => $modal_title,
	'data-bs-toggle'   => 'modal',
	'data-bs-target'   => '#videoModal',
);
if ( $custom_thumbnail ) {
	$button_attributes['data-custom-thumb'] = $custom_thumbnail;
}
echo '<button ' . cno_generate_html_attributes( $button_attributes ) . ">{$button_text}</button>";
if ( empty( $args['no_modal'] ) ) {
	get_template_part(
		'template-parts/modal',
		'video-modal',
		array(
			'modal_title'      => $modal_title,
			'video_id'         => $video_id,
			'custom_thumbnail' => $custom_thumbnail,
		)
	);

}
