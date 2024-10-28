<?php
/**
 * Slider Layout
 *
 * @package ChoctawNation
 * @subpackage ACF
 */

use ChoctawNation\ACF\Video_Details;
use ChoctawNation\Asset_Loader;
use ChoctawNation\Enqueue_Type;

$bg_image = get_template_directory_uri() . '/src/assets/white-texture.jpeg';
new Asset_Loader( 'profile-swiper', Enqueue_Type::both, 'pages' );

$pagination_color = cno_get_category_color( get_the_category( $post->ID )[0]->name );
?>
<section class="container-fluid gx-0 position-relative" id="profile-swiper">
	<img src="<?php echo $bg_image; ?>" class="position-absolute top-0 start-0 w-100 h-100" alt="" aria-hidden="true" />
	<div class="swiper">
		<div class="swiper-wrapper h-100">
			<div data-hash="slide1" class="swiper-slide p-5 h-100">
				<div class="d-grid h-100 overflow-hidden">
					<div class="cell cell--1">
						<?php
						$slide_1 = $args['slide_1'];
						echo wp_get_attachment_image(
							$slide_1['primary_image'],
							'full',
							false,
							array(
								'class'   => 'w-100 h-100 object-fit-scale',
								'loading' => 'lazy',
							)
						);
						?>
					</div>
					<div class="cell cell--2 mh-100 d-flex z-2">
						<?php
						echo wp_get_attachment_image(
							$slide_1['transparent_image'],
							'large',
							false,
							array(
								'class'   => 'w-75 h-75 object-fit-scale',
								'loading' => 'lazy',
							)
						);
						?>
					</div>
				</div>
				<span class="font-script position-absolute display-3 text-dark" id="swipe-text" data-aos="fade-in" data-aos-offset="200">Swipe -></span>
			</div>
			<div data-hash="slide2" class="swiper-slide h-100">
				<?php
				$slide_2 = $args['slide_2'];
				get_template_part(
					'template-parts/profile/content',
					'block-quote',
					array(
						'content' => $slide_2['quote'],
						'with_bg' => true,
						'class'   => 'display-5 text-center',
					)
				);
				?>
			</div>
			<div data-hash="slide3" class="swiper-slide d-flex flex-column justify-content-center align-items-center p-5">
				<?php $slide_3 = $args['slide_3']; ?>
				<figure class="h-100 d-flex flex-column justify-content-start align-items-center mb-0 row-gap-3 position-relative overflow-hidden">
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
					<figcaption class="px-5 fs-4 text-center">
						<?php echo $slide_3['caption']; ?>
					</figcaption>
				</figure>
			</div>
			<div data-hash="slide4" class="swiper-slide">
				<?php
				$slide_4 = $args['slide_4'];
				echo wp_get_attachment_image(
					$slide_4['image'],
					'full',
					false,
					array(
						'class'   => 'w-100 h-100 object-fit-cover',
						'loading' => 'lazy',
					)
				);
				?>
				<div class="inner-frame border border-1 border-white position-absolute z-2">
				</div>
				<div class="inner-frame__diamonds position-absolute z-2">
					<?php get_template_part( 'template-parts/ui/content', 'diamonds' ); ?>
				</div>
			</div>
			<div data-hash="slide5" class="swiper-slide">
				<?php
				$slide_5 = $args['slide_5'];
				echo wp_get_attachment_image(
					$slide_5['image'],
					'full',
					false,
					array(
						'class'   => 'w-100 h-100 object-fit-cover',
						'loading' => 'lazy',
					)
				);
				?>
			</div>
		</div>
		<div class="swiper-pagination" style="<?php echo "--swiper-pagination-color:var(--bs-{$pagination_color});"; ?>"></div>
	</div>
</section>