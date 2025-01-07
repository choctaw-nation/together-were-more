<?php
/**
 * Profile Slider Slide 3
 *
 * @package ChoctawNation
 */

use ChoctawNation\ACF\Video_Details;
$slide_3 = $args['slide_3'];
?>

<figure class="slide-container mb-0 position-relative d-flex flex-column justify-content-center align-items-center row-gap-2 h-100 flex-grow-1">
	<div class="media-container ratio ratio-1x1 w-75">
		<?php
		if ( $slide_3['is_video'] ) {
			$media_details = new Video_Details( $slide_3, $post->ID );
			$video_details = $media_details->get_the_video_details();
			echo $video_details['lite_vimeo'] ?: $video_details['fallback_iframe']; // phpcs:ignore Universal.Operators.DisallowShortTernary.Found
		} else {
			echo wp_get_attachment_image(
				$slide_3['image'],
				'large',
				false,
				array(
					'class'   => 'w-100 h-100 object-fit-cover',
					'loading' => 'lazy',
				)
			);
		}
		?>
	</div>
	<figcaption class="px-lg-5 fs-5 text-center">
		<?php echo $slide_3['caption']; ?>
	</figcaption>
</figure>
