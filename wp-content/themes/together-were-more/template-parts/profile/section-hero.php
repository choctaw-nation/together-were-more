<?php
/**
 * The Profile Hero Section
 *
 * @package ChoctawNation
 */

?>
<div class="profile-hero hero position-relative p-0 py-lg-5 d-flex align-items-center">
	<?php
	the_post_thumbnail(
		'hero',
		array(
			'class'           => 'bg-image object-fit-cover position-absolute top-0 start-0 w-100 h-100 z-n1 skip-lazy',
			'loading'         => 'eager',
			'data-spai-eager' => true,
		)
	);
	?>
	<div class="d-none d-lg-block bg-black bg-opacity-50 position-absolute w-100 h-100 top-0 z-n1"></div>
	<div class="container-fluid position-relative py-5 d-none d-lg-block">
		<div class="row justify-content-end align-items-center">
			<div class="col-7 col-md-6 d-flex flex-column flex-wrap align-items-center py-5 text-white">
				<?php get_template_part( 'template-parts/profile/content', 'hero-content' ); ?>
			</div>
		</div>
	</div>
</div>
<div class="mobile-hero-text text-bg-dark d-lg-none py-5">
	<div class="container">
		<div class="row">
			<div class="col d-flex flex-column align-items-center text-center">
				<?php get_template_part( 'template-parts/profile/content', 'hero-content' ); ?>
			</div>
		</div>
	</div>
</div>
<?php
$modal_title      = get_the_title();
$video_url        = mp_get_field( 'meta_vimeo_url' );
$video_id         = $video_url ? cno_extract_vimeo_id( $video_url ) : null;
$custom_thumbnail = cno_get_custom_mp_thumbnail();
if ( ! $video_id ) {
	while ( have_rows( 'meta_video_details' ) ) {
		the_row();
		$video_url = get_sub_field( 'video_url', false );
		$video_id  = cno_extract_vimeo_id( $video_url, );
		if ( ! $custom_thumbnail ) {
			$custom_thumbnail = get_sub_field( 'custom_thumbnail', false );
		}
	}
}

get_template_part(
	'template-parts/modal',
	'video-modal',
	array(
		'modal_title'      => $modal_title,
		'video_id'         => $video_id,
		'custom_thumbnail' => $custom_thumbnail,
	)
);
