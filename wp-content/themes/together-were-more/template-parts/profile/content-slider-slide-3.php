<?php
/**
 * Profile Slider Slide 3
 *
 * @package ChoctawNation
 */

use ChoctawNation\ACF\Video_Details;
$slide_3 = $args['slide_3'];
?>

<div class="slide-container d-flex justify-content-center align-items-center">
	<figure class="d-flex flex-column justify-content-start align-items-center mb-0 row-gap-3 position-relative overflow-hidden">
		<div class="media-container w-100">
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
		<figcaption class="px-lg-5 fs-4 text-center">
			<?php echo $slide_3['caption']; ?>
		</figcaption>
	</figure>
</div>
