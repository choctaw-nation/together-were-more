<?php
/**
 * Video Modal
 *
 * @package ChoctawNation
 */

$video_id = isset( $args['video_id'] ) ? $args['video_id'] : false;
if ( false === $video_id ) {
	return;
}
$modal_title      = isset( $args['modal_title'] ) ? $args['modal_title'] : false;
$custom_thumbnail = empty( $args['custom_thumbnail'] ) ? false : $args['custom_thumbnail'];
?>
<div class="modal fade" id="videoModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<?php $modal_title && "<h1 class='modal-title h5'>{$modal_title}</h1>"; ?>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php echo "<lite-vimeo videoid='{$video_id}' enableTracking" . ( $custom_thumbnail ? "unlisted customPlaceholder='{$custom_thumbnail}'" : '' ) . '></lite-vimeo>'; ?>
			</div>
		</div>
	</div>
</div>
